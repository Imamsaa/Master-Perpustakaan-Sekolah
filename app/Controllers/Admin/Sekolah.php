<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SekolahModel;

class Sekolah extends BaseController
{
    protected $sekolahModel;

    function __construct()
    {
        $this->sekolahModel = new SekolahModel();    
    }

    public function index()
    {
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $sekolah = $this->sekolahModel->first();
        // dd($sekolah);
        $data = [
            'title' => 'Profil Sekolah',
            'sekolah' => $sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/sekolah/index', $data);
    }

    function update()
    {
        $req = $this->request->getVar();
        $logo = $this->request->getFile('logo');
        $background = $this->request->getFile('background');
        $sekolah = $this->sekolahModel->first();

        $validate = [
            'logo' => [
                'rules' => 'max_size[logo,1024]|ext_in[logo,png,jpg,jpeg]|is_image[logo]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'ext_in' => 'Moson Masukan file Gambar',
                    'is_image' => 'Moson Masukan file Gambar Yang benar'
                ],
            ],
            'background' => [
                'rules' => 'max_size[background,2048]|ext_in[background,png,jpg,jpeg]|is_image[background]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'ext_in' => 'Moson Masukan file Gambar',
                    'is_image' => 'Moson Masukan file Gambar Yang benar'
                ],
            ],
        ];
        
        if (!$this->validate($validate)) {
            if ($this->validator->hasError('logo')) {
                $message = $this->validator->getError('logo');
            }elseif ($this->validator->hasError('background')) {
                $message = $this->validator->getError('background');
            }

            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Perhatian',
                'message' => $message
            ]);

            return redirect()->to(base_url('pustakawan/sekolah'))->withInput();
        }
        
        if ($logo->getError() == 4 ) {
            $name = $sekolah['logo'];
        }else{
            $name = $logo->getRandomName();
        }

        if ($background->getError() == 4 ) {
            $bname = $sekolah['background'];
        }else{
            $bname = $background->getRandomName();
        }
        
        
        $sekolahbaru = [
            'nama_sekolah' => $req['nama_sekolah'],
            'slogan_sekolah' => $req['slogan_sekolah'],
            'email_sekolah' => $req['email_sekolah'],
            'alamat_sekolah' => $req['alamat_sekolah'],
            'logo' => $name,
            'background' => $bname
        ];
        
        
        if ($logo->isvalid() && !$logo->hasMoved()) {
            $logo->move('admin/img/',$name);
        }

        if ($background->isvalid() && !$background->hasMoved()) {
            $background->move('img/',$bname);
        }

        if($this->sekolahModel->where('id',$sekolah['id'])->set($sekolahbaru)->update() == true )
        {
            session()->setFlashdata('kotaktime',[
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data Sekolah Berhasil Diubah'
            ]);
            if ($logo->getError() == 4 ) {
            
            }else{
                unlink('admin/img/'.$sekolah['logo']);
            }

            if ($background->getError() == 4 ) {
            
            }else{
                unlink('img/'.$sekolah['background']);
            }
            return redirect()->to(base_url('pustakawan/sekolah'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status' => 'error',
                'message' => 'Data Sekolah Gagal Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/sekolah'))->withInput();
        }
    }
}
