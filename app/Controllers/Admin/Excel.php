<?php

namespace App\Controllers\Admin;
require 'vendor/autoload.php';
use App\Controllers\BaseController;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory; 

class Excel extends BaseController
{
    protected $kelasModel;
    protected $siswaModel;

    function __construct()
    {
        $this->siswaModel = new SiswaModel();   
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
                    'nama_kelas' => $data[2],
                ];

                $this->kelasModel->insert($insertData);
            }
        unlink('uploads/'.$newName);
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
        unlink('uploads/'.$newName);
        return redirect()->to(base_url('pustakawan/siswa'));
        } else {
            return redirect()->to(base_url('pustakawan/siswa'));
        }
    }
}
