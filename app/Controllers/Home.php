<?php

namespace App\Controllers;
use App\Models\SiswaModel;
use App\Models\PengunjungModel;

class Home extends BaseController
{
    protected $siswaModel;
    protected $pModel;

    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->siswaModel = new SiswaModel();
        $this->pModel = new PengunjungModel();    
    }

    public function index(): string
    {
        session();
        $data = [
            'title' => 'Home Pengunjung',
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus
        ];
        return view('pages/home',$data);
    }

    function siswa()
    {
        $get = $this->request->getVar();
        $siswa = $this->siswaModel
        ->join('kelas', 'kelas.kode_kelas = siswa.kode_kelas')
        ->where('nis', $get['nis'])->first();
        if ($this->pModel->save([
            'nis' => $get['nis']
        ]) == true) {
            session()->setFlashdata('siswa',$siswa);
            return redirect()->to('');
        }else{
            return redirect()->to('');
        }

    }
}
