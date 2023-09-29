<?php

namespace App\Controllers\Admin;
require 'vendor/autoload.php';
use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\RakModel;
use App\Models\JenisModel;
use App\Models\BukuModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory; 

class Excel extends BaseController
{
    protected $kelasModel;
    protected $siswaModel;
    protected $rakModel;
    protected $jenisModel;
    protected $bukuModel;

    function __construct()
    {
        $this->siswaModel = new SiswaModel();   
        $this->kelasModel = new KelasModel(); 
        $this->rakModel = new RakModel();
        $this->jenisModel = new JenisModel();
        $this->bukuModel = new BukuModel(); 
    }

    public function kelas()
    {
        session();
        
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $upload = $this->request->getFile('kelas');

        if ($upload->isValid() && !$upload->hasMoved()) {
            $newName = $upload->getRandomName();
            $upload->move(ROOTPATH . 'public/uploads', $newName);

            $file_path = ROOTPATH . 'public/uploads/' . $newName;

            $spreadsheet = IOFactory::load($file_path);
            $worksheet = $spreadsheet->getActiveSheet();

            $headerRow = true;
            foreach ($worksheet->getRowIterator() as $row) {
                if ($headerRow) {
                    $headerRow = false;
                    continue;
                }

                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                $data = [];
                foreach ($cellIterator as $cell) {
                    $data[] = $cell->getValue();
                }

                // Sesuaikan dengan struktur tabel Anda
                $insertData = [
                    'kode_kelas' => $data[1],
                    'nama_kelas' => $data[2]
                ];

                $this->kelasModel->save($insertData);
            }
        unlink('uploads/' . $newName);
        return redirect()->to(base_url('pustakawan/kelas'));
        } else {
            return redirect()->to(base_url('pustakawan/kelas'));
        }
    }

    public function siswa()
    {
        session();
        $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $upload = $this->request->getFile('siswa');

        if ($upload->isValid() && !$upload->hasMoved()) {
            $newName = $upload->getRandomName();
            $upload->move(ROOTPATH . 'public/uploads', $newName);

            $file_path = ROOTPATH . 'public/uploads/' . $newName;

            $spreadsheet = IOFactory::load($file_path);
            $worksheet = $spreadsheet->getActiveSheet();

            $headerRow = true;
            foreach ($worksheet->getRowIterator() as $row) {
                if ($headerRow) {
                    $headerRow = false;
                    continue;
                }

                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                $data = [];
                foreach ($cellIterator as $cell) {
                    $data[] = $cell->getValue();
                }
                $barcodeImage = $generator->getBarcode($data[1], $generator::TYPE_CODE_128);
                // Sesuaikan dengan struktur tabel Anda
                $insertData = [
                    'nis' => $data[1],
                    'nisn' => $data[2],
                    'nama_siswa' => $data[3],
                    'kode_kelas' => $data[4],
                    'kode_tahun' => $data[5],
                    'wa' => $data[6],
                    'email' => $data[7],
                    'alamat_siswa' => $data[8],
                    'foto' => 'siswa_default.jpg',
                    'barcode_siswa' => $barcodeImage
                ];

                $this->siswaModel->save($insertData);
            }
        unlink(ROOTPATH . 'public/uploads/' . $newName);
        return redirect()->to(base_url('pustakawan/siswa'));
        } else {
            return redirect()->to(base_url('pustakawan/siswa'));
        }
    }

    public function rak()
    {
        session();
        
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $upload = $this->request->getFile('rak');

        if ($upload->isValid() && !$upload->hasMoved()) {
            $newName = $upload->getRandomName();
            $upload->move(ROOTPATH . 'public/uploads', $newName);

            $file_path = ROOTPATH . 'public/uploads/' . $newName;

            $spreadsheet = IOFactory::load($file_path);
            $worksheet = $spreadsheet->getActiveSheet();

            $headerRow = true;
            foreach ($worksheet->getRowIterator() as $row) {
                if ($headerRow) {
                    $headerRow = false;
                    continue;
                }

                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                $data = [];
                foreach ($cellIterator as $cell) {
                    $data[] = $cell->getValue();
                }

                // Sesuaikan dengan struktur tabel Anda
                $insertData = [
                    'kode_rak' => $data[1],
                    'nama_rak' => $data[2]
                ];

                $this->rakModel->save($insertData);
            }
        unlink('uploads/' . $newName);
        return redirect()->to(base_url('pustakawan/rak'));
        } else {
            return redirect()->to(base_url('pustakawan/rak'));
        }
    }

    public function jenis()
    {
        session();
        
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $upload = $this->request->getFile('jenis');

        if ($upload->isValid() && !$upload->hasMoved()) {
            $newName = $upload->getRandomName();
            $upload->move(ROOTPATH . 'public/uploads', $newName);

            $file_path = ROOTPATH . 'public/uploads/' . $newName;

            $spreadsheet = IOFactory::load($file_path);
            $worksheet = $spreadsheet->getActiveSheet();

            $headerRow = true;
            foreach ($worksheet->getRowIterator() as $row) {
                if ($headerRow) {
                    $headerRow = false;
                    continue;
                }

                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                $data = [];
                foreach ($cellIterator as $cell) {
                    $data[] = $cell->getValue();
                }

                // Sesuaikan dengan struktur tabel Anda
                $insertData = [
                    'kode_jenis' => $data[1],
                    'nama_jenis' => $data[2],
                    'kode_warna' => '#000000'
                ];

                $this->jenisModel->save($insertData);
            }
        unlink('uploads/' . $newName);
        return redirect()->to(base_url('pustakawan/jenis'));
        } else {
            return redirect()->to(base_url('pustakawan/jenis'));
        }
    }

    public function buku()
    {
        session();
        
        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $upload = $this->request->getFile('buku');

        require 'vendor/autoload.php';
        $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();

        if ($upload->isValid() && !$upload->hasMoved()) {
            $newName = $upload->getRandomName();
            $upload->move(ROOTPATH . 'public/uploads', $newName);

            $file_path = ROOTPATH . 'public/uploads/' . $newName;

            $spreadsheet = IOFactory::load($file_path);
            $worksheet = $spreadsheet->getActiveSheet();

            $headerRow = true;
            
            foreach ($worksheet->getRowIterator() as $row) {
                if ($headerRow) {
                    $headerRow = false;
                    continue;
                }

                
                
                
                
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                
                $data = [];
                
                foreach ($cellIterator as $cell) {
                    $data[] = $cell->getValue();
                }
                
                $kode = $this->bukuModel->selectMax('kode_buku', 'max_buku')->first();
                // apabila belum ada data buku maka kita set nomornya jadi 0
                $urutan = (int) substr($kode['max_buku'], 1, 4);
                if ($kode == null) {
                    $kode = 'B000000';
                }
                // $pertambahan = 0;
                for ($i=1; $i <= $data[8] ; $i++) { 
                    // kita ambil nomor urutnya dan mengubbahnya menjadi integer
                    
                    // Kita kombinasikan nomor buku dengan kode bawaan kita
                    $urutan++;
                    // $urutanAkhir = $urutan + $pertambahan;
                    $kode_buku = 'B'. sprintf("%04s", $urutan);

                    $barcodeImage = $generator->getBarcode($kode_buku, $generator::TYPE_CODE_128);
                    // Sesuaikan dengan struktur tabel Anda
                    $insertData = [
                        'kode_buku' => $kode_buku,
                        'judul_buku' => $data[1],
                        'slug' => url_title($data[1]),
                        'isbn'  => $data[2],
                        'tahun_buku' => $data[3],
                        'kode_penerbit' => $data[4],
                        'kode_rak' => $data[5],
                        'kode_jenis' => $data[6],
                        'halaman' => $data[7],
                        'sampul' => 'cover_default.png',
                        'barcode_buku' => $barcodeImage
                    ];
                    $this->bukuModel->save($insertData);
                    // $pertambahan++;
                }
            }
            unlink('uploads/' . $newName);
            return redirect()->to(base_url('pustakawan/buku'));
        } else {
            return redirect()->to(base_url('pustakawan/buku'));
        }
    }
}
