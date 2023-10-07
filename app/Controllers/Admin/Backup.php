<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Response;

class Backup extends BaseController
{
    public function index()
    {
        // Load library database
        $db = \Config\Database::connect();

        // Tentukan nama file backup dan direktori penyimpanan
        $backupFileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $backupFilePath = WRITEPATH . 'backup/' . $backupFileName;

        // Ambil semua tabel dari database
        $tables = $db->listTables();

        // Inisialisasi isi file SQL
        $sql = '';

        foreach ($tables as $table) {
            // Ambil struktur tabel
            $sql .= "DROP TABLE IF EXISTS $table;\n";
            $createTableSQL = $db->query('SHOW CREATE TABLE ' . $table)->getRowArray();
            $sql .= $createTableSQL['Create Table'] . ";\n";

            // Ambil data dari tabel
            $tableData = $db->query("SELECT * FROM $table")->getResultArray();

            if (!empty($tableData)) {
                foreach ($tableData as $row) {
                    $sql .= "INSERT INTO $table VALUES (";
                    $sql .= implode(', ', array_map(function ($value) use ($db) {
                        return $db->escape($value);
                    }, $row));
                    $sql .= ");\n";
                }
            }
        }

        // Simpan SQL ke file
        if (file_put_contents($backupFilePath, $sql) !== false) {
            // Berhasil membuat backup, arahkan ke halaman sukses
            $this->downloadBackup($backupFileName, $backupFilePath);
        } else {
            // Terjadi kesalahan saat membuat backup
            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Terjadi Kesalahan',
                'message' => 'Gagal Melakukan Backup Terhadap Database'
            ]);
            return redirect()->to(base_url('pustakawan'));
        }
    }

    protected function downloadBackup($fileName, $filePath)
    {
        if (file_exists($filePath)) {
            // Mengatur header untuk pengunduhan
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Content-Length: ' . filesize($filePath));
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            
            // Membaca file dan mengirimkan isinya ke output
            readfile($filePath);
            unlink($filePath);
            exit;
        } else {
            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Terjadi Kesalahan',
                'message' => 'Gagal Melakukan Backup Terhadap Database'
            ]);
            return redirect()->to(base_url('pustakawan'));
        }
    }
}
