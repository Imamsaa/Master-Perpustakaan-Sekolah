<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\KelasModel;

class Cetak extends BaseController
{
    protected $siswaModel;
    protected $kelasModel;

    function __construct()
    {
        $this->siswaModel = new SiswaModel;
        $this->kelasModel = new KelasModel;    
    }

    public function index($kode_kelas = null)
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'title' => 'Cetak Kartu Siswa',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];

        if ($kode_kelas == null) {
            $siswa = $this->siswaModel
            ->join('kelas','kelas.kode_kelas = siswa.kode_kelas')
            ->join('tahun_ajaran', 'tahun_ajaran.kode_tahun = siswa.kode_tahun')
            ->findAll();
            $data['siswa'] = $siswa;
        }else{
            $siswa = $this->siswaModel
            ->join('kelas','kelas.kode_kelas = siswa.kode_kelas')
            ->join('tahun_ajaran', 'tahun_ajaran.kode_tahun = siswa.kode_tahun')
            ->where('siswa.kode_kelas', $kode_kelas)
            ->findAll();
            $data['siswa'] = $siswa;
        }
        return view('admin/cetak/tampilsemua', $data);
    }

    function cetakperkelas($kode_kelas = null)
    {
        $siswa = $this->siswaModel
        ->join('kelas','kelas.kode_kelas = siswa.kode_kelas')
        ->join('tahun_ajaran', 'tahun_ajaran.kode_tahun = siswa.kode_tahun')
        ->where('siswa.kode_kelas',$kode_kelas)
        ->findAll();

        $data = [
            'title' => 'Cetak Kartu Siswa',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku,
            'siswa' => $siswa
        ];
        return view('admin/cetak/tampilsemua', $data);
    }

    function kelas()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $kelas = $this->kelasModel
        ->findAll();

        $data = [
            'title' => 'Cetak Kartu Siswa',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku,
            'kelas' => $kelas
        ];
        return view('admin/cetak/tampilkelas', $data);
    }

    function cetakkelas($kode_kelas = null)
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'title' => 'Cetak Kartu Siswa',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];

        if ($kode_kelas == null) {
            return view('admin/cetak/tampilkelas', $data);
        }else{
            $data['cetak'] = $this->siswaModel
            ->join('kelas', 'siswa.kode_kelas = kelas.kode_kelas')
            ->join('tahun_ajaran', 'tahun_ajaran.kode_tahun = siswa.kode_tahun')
            ->where('siswa.kode_kelas', $kode_kelas)
            ->findAll();
            return view('admin/cetak/cetakkartu', $data);
        }
    }

    function cetaksiswa($nis = null)
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'title' => 'Cetak Kartu Siswa',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];

        if ($nis == null) {
            $data['cetak'] = $this->siswaModel
            ->join('kelas','siswa.kode_kelas = kelas.kode_kelas')
            ->join('tahun_ajaran', 'siswa.kode_tahun = tahun_ajaran.kode_tahun')
            ->findAll();
            return view('admin/cetak/cetakkartu', $data);
        }else{
            $data['cetak'] = $this->siswaModel
            ->join('kelas','kelas.kode_kelas = siswa.kode_kelas')
            ->join('tahun_ajaran', 'siswa.kode_tahun = tahun_ajaran.kode_tahun')
            ->where('nis', $nis)->findAll();
            return view('admin/cetak/cetakkartu', $data);
        }
    }



    // CETAK BUKU


    public function buku()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'title' => 'Daftar Barcode Buku',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/cetak/tablebarcode', $data);
    }

    public function barcode()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'title' => 'Cetak Barcode Buku',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/cetak/cetakbarcode', $data);
    }

    public function cetak()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }
        $data = [
            'title' => 'Cetak Kartu Siswa',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/cetak/cetakkartu', $data);
    }
}
