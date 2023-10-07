<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Response;

class Backup extends BaseController
{
    private $backupFilePath; // Menambahkan variabel untuk menyimpan path file backup

    public function index()
    {
        // Load library database
        $db = \Config\Database::connect();

        // Tentukan nama file backup dan direktori penyimpanan
        $backupFileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $this->backupFilePath = WRITEPATH . 'backup/' . $backupFileName; // Simpan path file backup

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
        if (file_put_contents($this->backupFilePath, $sql) !== false) {
            // Berhasil membuat backup, arahkan ke halaman sukses
            $this->downloadBackup($backupFileName);
        } else {
            // Terjadi kesalahan saat membuat backup
            return redirect()->to(site_url('BackupController/error'));
        }
    }

    public function success($backupFileName)
    {
        return view('backup_success', ['backupFileName' => $backupFileName]);
    }

    public function error()
    {
        return view('backup_error');
    }

    public function downloadBackup($fileName)
    {
        if (file_exists($this->backupFilePath)) {
            // Membuat objek Response
            $request = service('request');
            $response = new Response($request);

            $response->setContentType('application/octet-stream');
            $response->setHeader('Content-Disposition', 'attachment; filename="' . basename($this->backupFilePath) . '"');
            $response->setHeader('Content-Length', filesize($this->backupFilePath));
            $response->setHeader('Content-Transfer-Encoding', 'binary');
            $response->setHeader('Cache-Control', 'public, max-age=0');
            $response->setBody(file_get_contents($this->backupFilePath));
            return $response;
        } else {
            // File backup tidak ditemukan
            return redirect()->to(site_url('BackupController/error'));
        }
    }
}
