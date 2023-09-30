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
        $siswaall = $this->siswaModel->findAll();

        foreach ($siswaall as $all) {
            if ($all['nis'] == $get['nis']) {

                $siswa = $this->siswaModel
                ->join('kelas', 'kelas.kode_kelas = siswa.kode_kelas')
                ->join('tahun_ajaran', 'tahun_ajaran.kode_tahun = siswa.kode_tahun')
                ->where('nis', $get['nis'])->first();

                if ($siswa['kadaluarsa'] <= date('Y-m-d')) {
                    session()->setFlashdata('kotaktime',[
                        'status' => 'error',
                        'title' => 'Gagal',
                        'message' => 'Masa Berlaku Sudah Habis'
                    ]);
                    return redirect()->to('');
                }

                if ($this->pModel->save([
                    'nis' => $get['nis']
                ]) == true) {
                    session()->setFlashdata('siswa',$siswa);
                    session()->setFlashdata('kotaktime',[
                        'status' => 'success',
                        'title' => 'Berhasil',
                        'message' => 'Selamat Datang '.$siswa['nama_siswa']
                    ]);
                    return redirect()->to('');
                }
            }
        }

        session()->setFlashdata('kotaktime',[
            'status' => 'error',
            'title' => 'Gagal',
            'message' => 'NIS Tidak Terdaftar'
        ]);
        return redirect()->to('');
    }
}
