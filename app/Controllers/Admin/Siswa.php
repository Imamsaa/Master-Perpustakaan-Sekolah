<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\TahunModel;

class Siswa extends BaseController
{
    protected $siswaModel;
    protected $kelasModel;
    protected $tahunModel;
    protected $db;

    function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        $this->tahunModel = new TahunModel();
        $this->db = \Config\Database::connect();
    }

    public function index(): string
    {
        session();
        $builder = $this->db->table('siswa');
        $siswa = $builder->join('kelas','kelas.kode_kelas = siswa.kode_kelas')->get();
        $data = [
            'title' => 'Daftar Siswa',
            'siswa' => $siswa->getResultArray()
        ];
        return view('admin/siswa/tablesiswa', $data);
    }

    public function tambah(): string
    {
        session();
        $kelas = $this->kelasModel->findAll();
        $tahun = $this->tahunModel->findAll();
        $data = [
            'title' => 'Tambah Siswa',
            'kelas' => $kelas,
            'tahun' => $tahun
        ];
        return view('admin/siswa/addsiswa', $data);
    }

    function save()
    {
        $validate = [
            'nis' => [
                'rules' => 'is_unique[siswa.nis]',
                'errors' => [
                    'is_unique' => 'Nis Sudah dipakai'
                ],
            ],
            'nisn' => [
                'rules' => 'is_unique[siswa.nisn]',
                'errors' => [
                    'is_unique' => 'Nisn Sudah dipakai'
                ],
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|ext_in[foto,png,jpg,jpeg]|is_image[foto]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'ext_in' => 'Moson Masukan file Gambar',
                    'is_image' => 'Moson Masukan file Gambar Yang benar'
                ],
            ],
        ];

        if (!$this->validate($validate)) {
            session()->setFlashdata('errors',$this->validator);
            return redirect()->to(base_url('pustakawan/siswa/tambah'))->withInput();
        }

        $foto = $this->request->getFile('foto');

        if ($foto->getError() == 4 ) {
            $name = "siswa_default.jpg";
        }else{
            $name = $foto->getRandomName();
        }
        $siswa = $this->request->getvar();

        if ($foto->isvalid() && !$foto->hasMoved()) {
            $foto->move('admin/img/siswa',$name);
        }
        
        if ($this->siswaModel->save([
            'nis' => $siswa['nis'],
            'nisn' => $siswa['nisn'],
            'nama_siswa' => $siswa['nama_siswa'],
            'kode_kelas' => $siswa['kode_kelas'],
            'kode_tahun' => $siswa['kode_tahun'],
            'wa' => $siswa['wa'],
            'email' => $siswa['email'],
            'alamat_siswa' => $siswa['alamat_siswa'],
            'foto' => $name
        ]) == true
        ) {
            session()->setFlashdata('session',[
                'status' => 'success',
                'message' => 'Data Siswa Berhasil disimpan'
            ]);
            return redirect()->to(base_url('pustakawan/siswa'));
        }else{
            session()->setFlashdata('session',[
                'status' => 'error',
                'message' => 'Data Siswa Gagal disimpan'
            ]);
            return redirect()->to(base_url('pustakawan/siswa/tambah'))->withInput();
        }
    }

    public function ubah($nis): string
    {
        session();
        $kelas = $this->kelasModel->findAll();
        $tahun = $this->tahunModel->findAll();
        $siswa = $this->siswaModel->where('nis',$nis)->first();
        $data = [
            'title' => 'Ubah Siswa',
            'siswa' => $siswa,
            'kelas' => $kelas,
            'tahun' => $tahun
        ];
        return view('admin/siswa/editsiswa', $data);
    }

    public function hapus()
    {
        // isi kode disini
    }
}
