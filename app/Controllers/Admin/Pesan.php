<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\SettransaksiModel;
use App\Models\SiswaModel;
use App\Models\KelasModel;
use App\Models\WhastappModel;
use App\Models\EmailModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Pesan extends BaseController
{
    protected $whastappModel;
    protected $trans;
    protected $setTrans;
    protected $siswaModel;
    protected $emailModel;

    function __construct()
    {
        $this->trans = new TransaksiModel();
        $this->setTrans = new SettransaksiModel();
        $this->siswaModel = new SiswaModel();  
        $this->whastappModel = new WhastappModel();  
        $this->emailModel = new EmailModel();  
    }

    public function index()
    {
        session();

        if (session()->get('login') == null) {
            return redirect()->to(base_url('login'));
        }

        $kirim = [];
        $set = $this->setTrans->first();
        // $pinjam = $this->trans->where('status','pinjam')->findAll();
        $now  = date_create();
        $proses = $this->trans
        ->join('siswa','siswa.nis = transaksi.nis')
        ->join('buku','buku.kode_buku = transaksi.kode_buku')
        ->join('kelas','kelas.kode_kelas = siswa.kode_kelas')
        ->where('status','pinjam')
        ->findAll();

        foreach ($proses as $p) {

            $ambil = date_diff(date_create($p['pinjam']),$now);

            $terlambat = $ambil->days - $set['terlambat'];

            if ($terlambat < 1) {
                $hasil = 0;
            }elseif($set['terlambat'] == 0){
                $hasil = 0;
            }else{
                $hasil = $terlambat;
            }

            $kirim[] = [
                'nis' => $p['nis'],
                'nama_siswa' => $p['nama_siswa'],
                'kode_buku' => $p['kode_buku'],
                'judul_buku' => $p['judul_buku'],
                'terlambat' => $hasil,
                'denda' => $hasil*$set['denda']
            ];
        }

        $data = [
            'title' => 'Kirim Pesan',
            'pesan' => $kirim,
            'sekolah' => $this->sekolah,
            'perpus' => $this->perpus,
            'aku' => $this->aku
        ];
        return view('admin/pesan/index',$data);
    }

    function setpesan($nis , $selector , $message)
    {
        $pecah = explode($selector, $message);
        $element = $this->trans
        ->join('siswa','siswa.nis = transaksi.nis')
        ->join('buku','buku.kode_buku = transaksi.kode_buku')
        ->join('kelas', 'siswa.kode_kelas = kelas.kode_kelas')
        ->join('penerbit','buku.kode_penerbit = penerbit.kode_penerbit')
        ->join('rak','rak.kode_rak = buku.kode_rak')
        ->join('jenis_buku', 'jenis_buku.kode_jenis = buku.kode_jenis')
        ->where('siswa.nis',$nis)
        ->first();
        
        //DENDA
        $set = $this->setTrans->first();
        $now  = date_create();
        $ambil = date_diff(date_create($element['pinjam']),$now);

        $terlambat = $ambil->days - $set['terlambat'];

        if ($terlambat < 1) {
            $element['terlambat_siswa'] = 0;
        }elseif($set['terlambat'] == 0){
            $element['terlambat_siswa'] = 0;
        }else{
            $element['terlambat_siswa'] = $terlambat;
        }
        $element['denda_siswa'] = $element['terlambat_siswa']*$set['denda'];

        $result = [];
        foreach ($pecah as $p => $pvalue) {
            unset($var);
            foreach ($element as $key => $value) {
                if ($pvalue == $key) {
                    $var = $value;
                }
            }
            $result[] = (isset($var)) ? $var : $pvalue;
        }
        return implode(" ",$result); 
    }

    function whastapp($nis)
    {
        // AMBIL DATABASE
        $siswa = $this->siswaModel->where('nis',$nis)->first();
        $wa = $this->whastappModel->first();
        $message = urlencode($this->setpesan($nis, $wa['selector'],$wa['message']));

        // BUAT CURL
        $fp = @fsockopen('www.google.com', 80, $errno, $errstr, 30);
        if (!$fp) {
            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Gagal',
                'message' => 'Untuk Mengirim Pesan Diperlukan Koneksi Internet Coba Cek Kembali Koneksi Internet Anda'
            ]);
            return redirect()->to(base_url('pustakawan/kirimpesan'));
        }

        $url = $wa['endpoint'].'?api_key='.$wa['apikey']."&sender=".$wa['pengirim']."&number=".$siswa['wa']."&message=".$message;
        
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

        /* Get the HTML or whatever is linked in $url. */
        $response = curl_exec($handle);

        /* Check for 404 (file not found). */
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if($httpCode == 400) {
            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Gagal',
                'message' => 'Terdapat Kesalahan Pada Konfigurasi Pesan WhastApp Anda Coba Cek Kembali Konfigurasi dan Pastikan Nomor Penerima Aktif'
            ]);
            return redirect()->to(base_url('pustakawan/kirimpesan'));
        }elseif($httpCode == 200){
            session()->setFlashdata('kotaktime',[
                'status' => 'success',
                'title' => 'Terkirim',
                'message' => 'Pesan WhastApp Berhasil Terkirim'
            ]);
            return redirect()->to(base_url('pustakawan/kirimpesan'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status' => 'error',
                'message' => 'Pesan WhastApp Gagal Terkirim'
            ]);
            return redirect()->to(base_url('pustakawan/kirimpesan'));
        }
        curl_close($handle);
    }

    function email($nis)
    {
        // Inisialisasi objek PHPMailer
        $mail = new PHPMailer(true); // Buat objek PHPMailer dengan mode debugging aktif

        $vmail = $this->emailModel->first();

        // Konfigurasi SMTP
        $mail->isSMTP(); // Menggunakan SMTP
        $mail->Host = $vmail['smtp']; // Ganti dengan server SMTP Anda
        $mail->SMTPAuth = true; // Mengaktifkan otentikasi SMTP
        $mail->Username = $vmail['email']; // Ganti dengan email pengirim
        $mail->Password = $vmail['password_email']; // Ganti dengan kata sandi pengirim
        $mail->SMTPSecure = 'tls'; // Ganti dengan 'ssl' jika diperlukan
        $mail->Port = $vmail['port']; // Ganti port SMTP sesuai kebutuhan

        // Alamat pengirim
        $mail->setFrom($vmail['email'], $vmail['nama']);


        $tujuan = $this->siswaModel->where('nis',$nis)->first();

        // Alamat penerima
        $mail->addAddress($tujuan['email'],$tujuan['nama_siswa']);

        // Subjek dan isi pesan email
        $mail->Subject = $vmail['subject'];
        $mail->Body = $this->setpesan($nis,$vmail['selector'],$vmail['message']);

        $fp = @fsockopen('www.google.com', 80, $errno, $errstr, 30);
        if (!$fp) {
            session()->setFlashdata('kotakok',[
                'status' => 'warning',
                'title' => 'Gagal',
                'message' => 'Untuk Mengirim Pesan Diperlukan Koneksi Internet Coba Cek Kembali Koneksi Internet Anda'
            ]);
            return redirect()->to(base_url('pustakawan/kirimpesan'));
        }
        // Mengirim email
        if ($mail->send()) {
            session()->setFlashdata('kotaktime',[
                'status' => 'success',
                'title' => 'Terkirim',
                'message' => 'Pesan Email Berhasil Terkirim'
            ]);
            return redirect()->to(base_url('pustakawan/kirimpesan'));
        }else{
            session()->setFlashdata('pojokatas',[
                'status' => 'error',
                'message' => 'Pesan WhastApp Gagal Terkirim'
            ]);
            return redirect()->to(base_url('pustakawan/kirimpesan'));
        }
    }
}
