<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\PengunjungModel;
use App\Models\BukuModel;
use App\Models\TransaksiModel;
use App\Models\KelasModel;

class Dashboard extends BaseController
{
    protected $siswaModel;
    protected $pModel;
    protected $bukuModel;
    protected $kelasModel;
    protected $trans;

    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->siswaModel = new SiswaModel();
        $this->pModel = new PengunjungModel();
        $this->bukuModel = new BukuModel();
        $this->kelasModel = new KelasModel();
        $this->trans = new TransaksiModel();
    }

    public function index()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $jp = $this->pModel
        ->like('waktu',date('Y-m-d'))
        ->countAllResults();

        $jpinjam = $this->trans
        ->like('status','pinjam')
        ->countAllResults();

        $jsiswa = $this->siswaModel
        ->countAllResults();

        $jbuku = $this->bukuModel
        ->countAllResults();

        $pday = $this->pModel
        ->join('siswa','siswa.nis = pengunjung.nis')
        ->join('kelas','kelas.kode_kelas = siswa.kode_kelas')
        ->like('waktu',date('Y-m-d'))
        ->findAll();

        $presen = [];
        foreach ($this->kelasModel->findAll() as $v) {
            $presen[] = [
                'nama_kelas' => $v['nama_kelas'],
                'total' => $this->pModel->join('siswa','pengunjung.nis = siswa.nis')->like('siswa.kode_kelas',$v['kode_kelas'])->countAllResults(),
                'persen' => round(($this->pModel->join('siswa','pengunjung.nis = siswa.nis')->like('siswa.kode_kelas',$v['kode_kelas'])->countAllResults()/$this->pModel->countAllResults())*100)
            ];
        }
        // dd($presen);

        $data = [
            'title' => 'Dashboard Pustakawan',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku,
            'jp' => $jp,
            'pinjam' => $jpinjam,
            'jsiswa' => $jsiswa,
            'jbuku' => $jbuku,
            'pday' => $pday,
            'presen' => $presen
        ];
        return view('admin/dashboard/dashboard', $data);
    }
}
