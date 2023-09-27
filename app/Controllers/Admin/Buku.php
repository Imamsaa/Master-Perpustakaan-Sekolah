<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\PenerbitModel;
use App\Models\RakModel;
use App\Models\JenisModel;

class Buku extends BaseController
{
    protected $bukuModel;
    protected $penerbitModel;
    protected $rakModel;
    protected $jenisModel;
    protected $db;

    function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->penerbitModel = new PenerbitModel();
        $this->rakModel = new RakModel();
        $this->jenisModel = new JenisModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        // QUERY SELECT
        $builder = $this->db->table('buku');
        $builder->select('*,COUNT(judul_buku) stok')
        ->join('penerbit','buku.kode_penerbit = penerbit.kode_penerbit')
        ->join('rak','buku.kode_rak = rak.kode_rak')
        ->join('jenis_buku', 'buku.kode_jenis = jenis_buku.kode_jenis')
        ->groupBy('judul_buku');
        $buku = $builder->get()->getResultArray();

        $data = [
            'title' => 'Daftar Buku',
            'buku'  => $buku,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/buku/tablebuku', $data);
    }

    public function tambah()
    {
        session();
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $penerbit = $this->penerbitModel->findAll();
        $rak = $this->rakModel->findAll();
        $jenis = $this->jenisModel->findAll();
        $data = [
            'title' => 'Tambah Buku',
            'penerbit' => $penerbit,
            'rak' => $rak,
            'jenis' => $jenis,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/buku/addbuku', $data);
    }

    function save()
    {
        // Membuat validasi untuk input file
        $validate = [
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|ext_in[sampul,png,jpg,jpeg]|is_image[sampul]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'ext_in' => 'Moson Masukan file Gambar',
                    'is_image' => 'Moson Masukan file Gambar Yang benar'
                ],
            ],
            'judul_buku' => [
                'rules' => 'is_unique[buku.judul_buku]',
                'errors' => [
                    'is_unique' => 'Judul Buku Telah Digunakan'
                ],
            ],
        ];

        // Melakukan Validasi dengan fungsi $this->validate()
        if (!$this->validate($validate)) {
            // dd($this->validator->getErrors());
            session()->setFlashdata('errors',$this->validator);
            return redirect()->to(base_url('pustakawan/buku/tambah'))->withInput();
        }

        // Apabila berhasil tanpa error sekarang kita ambil request filenya
        $sampul = $this->request->getFile('sampul');

        // Kita cek apakah user melakukan uploadfile atau tidak jika tidak kita isi dengan cover default
        if ($sampul->getError() == 4 ) {
            $name = "cover_default.png";
        }else{
            $name = $sampul->getRandomName();
        }

        // Setelah melakukan validasi pada file, kita ambil request form terlebih dahulu
        $buku = $this->request->getVar();

        // lalu kita pindah file gambar yang di input ke folder admin/img/buku
        if ($sampul->isvalid() && !$sampul->hasMoved()) {
            $sampul->move('admin/img/buku',$name);
        }

        if ($buku['stok'] <= 0 ) {
            session()->setFlashdata('session',[
                'status' => 'error',
                'message' => 'Stok buku tidak boleh kosong'
            ]);
            return redirect()->to(base_url('pustakawan/buku/tambah'))->withInput();
        }
        // Kita Buat perulangan untuk insert data buku sebanyak stok buku
        require 'vendor/autoload.php';
        $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();

        $pertambahan = 0;

        for ($i=1; $i <= $buku['stok'] ; $i++) { 

            // kita buat kode bawaan kita untuk identifikasi buku
            $kode_depan = $buku['kode_penerbit'][0].$buku['kode_rak'][0].$buku['kode_jenis'][0];
            
            // kita ambil nomor urut terakhir dari database buku
            $kode = $this->bukuModel->selectMax('kode_buku', 'max_buku')->first();

            // apabila belum ada data buku maka kita set nomornya jadi 0
            if ($kode == null) {
                $kode = 'B000000';
            }

            // kita ambil nomor urutnya dan mengubbahnya menjadi integer
            $urutan = (int) substr($kode['max_buku'], 1, 4);

            // Kita kombinasikan nomor buku dengan kode bawaan kita
            $urutan++;
            $urutanAkhir = $urutan + $pertambahan;
            $kode_buku = 'B'. sprintf("%04s", $urutanAkhir) . $kode_depan;

            // kita buat array untuk insert data buku
            $barcodeImage = $generator->getBarcode($kode_buku, $generator::TYPE_CODE_128);
            $bulkBuku[] = [
                'kode_buku' => $kode_buku,
                'judul_buku' => $buku['judul_buku'],
                'slug' => url_title($buku['judul_buku'],'-',true),
                'isbn' => $buku['isbn'],
                'tahun_buku' => $buku['tahun_buku'],
                'kode_penerbit' => $buku['kode_penerbit'],
                'kode_rak' => $buku['kode_rak'],
                'kode_jenis' => $buku['kode_jenis'],
                'halaman' => $buku['halaman'],
                'deskripsi_buku' => $buku['deskripsi_buku'],
                'sampul' => $name,
                'barcode_buku' => $barcodeImage
            ];
            $pertambahan++;
        }

        // kita buat builder dulu untuk isert massal
        $builder = $this->db->table('buku');

        // kita lakukan insert sekaligus pengecekan
        if ($builder->insertBatch($bulkBuku) == true) {
           session()->setFlashdata('session',[
            'status' => 'success',
            'message' => 'Berhasil Menambahkan data buku'
           ]);
           return redirect()->to(base_url('pustakawan/buku'));
        } else{
            session()->setFlashdata('session',[
                'status' => 'success',
                'message' => 'Berhasil Menambahkan data buku'
            ]);
            return redirect()->to(base_url('pustakawan/buku/tambah'))->withInput();
        }
    }

    public function ubah($slug)
    {
        session();
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $builder = $this->db->table('buku');
        $table = $builder
        ->join('jenis_buku','jenis_buku.kode_jenis = buku.kode_jenis')
        ->join('rak','rak.kode_rak = buku.kode_rak')
        ->where('slug',$slug)
        ->get()
        ->getResultArray();
        $buku = $this->bukuModel->where('slug',$slug)->first();
        $penerbit = $this->penerbitModel->findAll();
        $rak = $this->rakModel->findAll();
        $jenis = $this->jenisModel->findAll();
        $data = [
            'title' => 'Ubah Buku',
            'table' => $table,
            'buku'  => $buku,
            'penerbit' => $penerbit,
            'rak'   => $rak,
            'jenis' => $jenis,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/buku/editbuku', $data);
    }

    function deleteBuku($slug,$kode_buku)
    {
        $buku = $this->bukuModel->where('kode_buku', $kode_buku)->first();
        if ($this->bukuModel->where('kode_buku',$kode_buku)->delete() == true) {
            session()->setFlashdata('session',[
                'status' => 'success',
                'message' => 'Buku Berhasil di hapus'
            ]);
            if ($this->bukuModel->where('slug',$slug)->countAllResults() > 0) {
                return redirect()->to(base_url('pustakawan/buku/ubah/'.$slug));   
            }else{
                unlink('admin/img/buku/'.$buku['sampul']);
                return redirect()->to(base_url('pustakawan/buku'));
            }
        }else{
            session()->setFlashdata('session',[
                'status' => 'error',
                'message' => 'Buku gagal di hapus'
            ]);
            return redirect()->to(base_url('pustakawan/buku/ubah/'.$slug));
        }
    }

    function update()
    {
        // Membuat validasi untuk input file
        $validate = [
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|ext_in[sampul,png,jpg,jpeg]|is_image[sampul]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'ext_in' => 'Moson Masukan file Gambar',
                    'is_image' => 'Moson Masukan file Gambar Yang benar'
                ],
            ],
        ];
        
        $buku = $this->request->getVar();
        $bukulama = $this->bukuModel->where('kode_buku', $buku['kode_buku'])->first();
        $caribuku = $this->bukuModel->findAll();
        $sampul = $this->request->getFile('sampul');
        $slug = url_title($buku['judul_buku'],'-',true);

        if ($buku['judul_buku'] == $bukulama['judul_buku']) {
            $judul = $buku['judul_buku'];
        }else{
            foreach ($caribuku as $v) {
                if ($v['judul_buku'] == $bukulama['judul_buku']) {
                    session()->setFlashdata('session',[
                        'status' => 'error',
                        'message' => 'Judul Buku Telah Dipakai'
                    ]);
                    return redirect()->to(base_url('pustakawan/buku/ubah/'.$slug));        
                }else {
                    $judul = $buku['judul_buku'];
                }
            }
        }
        
        if ($sampul->getError() == 4 ) {
            $name = "cover_default.png";
        }else{
            $name = $sampul->getRandomName();
        }

        $bukubaru = [
            'judul_buku' => $buku['judul_buku'],
            'slug' => $slug,
            'isbn' => $buku['isbn'],
            'tahun_buku' => $buku['tahun_buku'],
            'kode_penerbit' => $buku['kode_penerbit'],
            'kode_rak' => $buku['kode_rak'],
            'kode_jenis' => $buku['kode_jenis'],
            'halaman' => $buku['halaman'],
            'deskripsi_buku' => $buku['deskripsi_buku'],
            'sampul' => $name
        ];
        
        // Melakukan Validasi dengan fungsi $this->validate()
        if (!$this->validate($validate)) {
            // dd($this->validator->getErrors());
            session()->setFlashdata('errors',$this->validator);
            return redirect()->to(base_url('pustakawan/buku/ubah/'.$bukulama['slug']))->withInput();
        }
        
        // Apabila berhasil tanpa error sekarang kita ambil request filenya

        // Kita cek apakah user melakukan uploadfile atau tidak jika tidak kita isi dengan cover default

        // Setelah melakukan validasi pada file, kita ambil request form terlebih dahulu

        // lalu kita pindah file gambar yang di input ke folder admin/img/buku
        if ($sampul->isvalid() && !$sampul->hasMoved()) {
            $sampul->move('admin/img/buku',$name);
        }


        if($this->bukuModel->where('slug',$bukulama['slug'])->set($bukubaru)->update() == true )
        {
            session()->setFlashdata('session',[
                'status' => 'success',
                'message' => 'Buku Berhasil Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/buku/ubah/'.$slug));
        }else{
            session()->setFlashdata('session',[
                'status' => 'error',
                'message' => 'Buku Gagal Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/buku/ubah/'.$slug))->withInput();
        }
    }

    function delete($slug)
    {
        $buku = $this->bukuModel->first();
        if ($this->bukuModel->where('slug',$slug)->delete() == true) {
            session()->setFlashdata('session',[
                'status' => 'success',
                'message' => 'Buku Berhasil Dihapus'
            ]);
            unlink('admin/img/buku/'.$buku['sampul']);
            return redirect()->to(base_url('pustakawan/buku'));
        }else{
            session()->setFlashdata('session',[
                'status' => 'error',
                'message' => 'Buku Gagal Dihapus'
            ]);
            return redirect()->to(base_url('pustakawan/buku'));
        }
    }

    function stok()
    {
        $req = $this->request->getVar();
        $buku = $this->bukuModel->where('slug',$req['slug'])->first();
        // dd($buku);

        require 'vendor/autoload.php';
        $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();
        $pertambahan = 0;
        for ($i=1; $i <= $req['stok'] ; $i++) { 

            // kita buat kode bawaan kita untuk identifikasi buku
            $kode_depan = $buku['kode_penerbit'][0].$buku['kode_rak'][0].$buku['kode_jenis'][0];
            
            // kita ambil nomor urut terakhir dari database buku
            $kode = $this->bukuModel->selectMax('kode_buku', 'max_buku')->first();

            // apabila belum ada data buku maka kita set nomornya jadi 0
            if ($kode == null) {
                $kode = 'B000000';
            }

            // kita ambil nomor urutnya dan mengubbahnya menjadi integer
            $urutan = (int) substr($kode['max_buku'], 1, 4);

            // Kita kombinasikan nomor buku dengan kode bawaan kita
            $urutan++;
            $urutanAkhir = $urutan + $pertambahan;
            $kode_buku = 'B'. sprintf("%04s", $urutanAkhir) . $kode_depan;
            $barcodeImage = $generator->getBarcode($kode_buku, $generator::TYPE_CODE_128);
            // kita buat array untuk insert data buku
            $bulkBuku[] = [
                'kode_buku' => $kode_buku,
                'judul_buku' => $buku['judul_buku'],
                'slug' => $buku['slug'],
                'isbn' => $buku['isbn'],
                'tahun_buku' => $buku['tahun_buku'],
                'kode_penerbit' => $buku['kode_penerbit'],
                'kode_rak' => $buku['kode_rak'],
                'kode_jenis' => $buku['kode_jenis'],
                'halaman' => $buku['halaman'],
                'deskripsi_buku' => $buku['deskripsi_buku'],
                'sampul' => $buku['sampul'],
                'barcode_buku' => $barcodeImage
            ];
            $pertambahan++;
        }

        $builder = $this->db->table('buku');

        // kita lakukan insert sekaligus pengecekan
        if ($builder->insertBatch($bulkBuku) == true) {
           session()->setFlashdata('session',[
            'status' => 'success',
            'message' => 'Berhasil Menambahkan data buku'
           ]);
           return redirect()->to(base_url('pustakawan/buku/ubah/'.$req['slug']));
        } else{
            session()->setFlashdata('session',[
                'status' => 'success',
                'message' => 'Berhasil Menambahkan data buku'
            ]);
            return redirect()->to(base_url('pustakawan/buku/ubah/'.$req['slug']));
        }
    }
}
