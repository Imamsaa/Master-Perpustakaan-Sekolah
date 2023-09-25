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

    public function index(): string
    {
        $sekolah = $this->sekolahModel->first();
        $data = [
            'title' => 'Profil Sekolah',
            'sekolah' => $sekolah
        ];
        return view('admin/sekolah/index', $data);
    }

    function update()
    {
        $req = $this->request->getVar();
        $logo = $this->request->getFile('logo');
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
        ];
        
        
        if ($logo->getError() == 4 ) {
            $name = $sekolah['logo'];
        }else{
            $name = $logo->getRandomName();
        }
        
        
        $sekolahbaru = [
            'nama_sekolah' => $req['nama_sekolah'],
            'slogan_sekolah' => $req['slogan_sekolah'],
            'email_sekolah' => $req['email_sekolah'],
            'alamat_sekolah' => $req['alamat_sekolah'],
            'logo' => $name
        ];
        
        if (!$this->validate($validate)) {
            // dd($this->validator->getErrors());
            session()->setFlashdata('errors',$this->validator);
            return redirect()->to(base_url('pustakawan/sekolah'))->withInput();
        }
        
        if ($logo->isvalid() && !$logo->hasMoved()) {
            $logo->move('admin/img/',$name);
        }

        if($this->sekolahModel->where('id',$sekolah['id'])->set($sekolahbaru)->update() == true )
        {
            session()->setFlashdata('session',[
                'status' => 'success',
                'message' => 'Data Sekolah Berhasil Diubah'
            ]);
            unlink('admin/img/'.$sekolah['logo']);
            return redirect()->to(base_url('pustakawan/sekolah'));
        }else{
            session()->setFlashdata('session',[
                'status' => 'error',
                'message' => 'Data Sekolah Gagal Diubah'
            ]);
            return redirect()->to(base_url('pustakawan/sekolah'))->withInput();
        }
    }
}
