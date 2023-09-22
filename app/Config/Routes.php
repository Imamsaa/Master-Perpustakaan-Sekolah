<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->get('/register', 'Register::index');
$routes->get('/peminjaman', 'Peminjaman::index');
$routes->get('/pengembalian', 'Pengembalian::index');

// DASHBOARD

$routes->get('/pustakawan', 'Admin\Dashboard::index');

// KELAS

$routes->get('/pustakawan/kelas', 'Admin\Kelas::index');
$routes->get('/pustakawan/kelas/tambah', 'Admin\Kelas::tambah');
$routes->get('/pustakawan/kelas/ubah/(:any)', 'Admin\Kelas::ubah/$1');
$routes->post('/pustakawan/kelas/save', 'Admin\Kelas::save');
$routes->post('/pustakawan/kelas/update', 'Admin\Kelas::update');

// SISWA

$routes->get('/pustakawan/siswa', 'Admin\Siswa::index');
$routes->get('/pustakawan/siswa/tambah', 'Admin\Siswa::tambah');
$routes->get('/pustakawan/siswa/ubah', 'Admin\Siswa::ubah');

// TAHUN

$routes->get('/pustakawan/tahun', 'Admin\Tahun::index');
$routes->get('/pustakawan/tahun/tambah', 'Admin\Tahun::tambah');
$routes->get('/pustakawan/tahun/ubah/(:any)', 'Admin\Tahun::ubah/$1');
$routes->post('/pustakawan/tahun/update', 'Admin\Tahun::update');
$routes->post('/pustakawan/tahun/save', 'Admin\Tahun::save');
$routes->DELETE('/pustakawan/tahun/delete/(:any)', 'Admin\Tahun::delete/$1');

// CETAK

$routes->get('/pustakawan/siswa/cetak', 'Admin\Cetak::index');
$routes->get('/pustakawan/buku/cetak', 'Admin\Cetak::buku');
$routes->get('/pustakawan/siswa/cetak/ya', 'Admin\Cetak::cetak');
$routes->get('/pustakawan/buku/cetak/ya', 'Admin\Cetak::barcode');

// PENERBIT

$routes->get('/pustakawan/penerbit', 'Admin\Penerbit::index');
$routes->get('/pustakawan/penerbit/tambah', 'Admin\Penerbit::tambah');
$routes->get('/pustakawan/penerbit/ubah/(:any)', 'Admin\Penerbit::ubah/$1');
$routes->post('/pustakawan/penerbit/save', 'Admin\Penerbit::save');
$routes->post('/pustakawan/penerbit/update', 'Admin\Penerbit::update');
$routes->DELETE('/pustakawan/penerbit/delete/(:any)', 'Admin\Penerbit::delete/$1');

// Rak Buku

$routes->get('/pustakawan/rak', 'Admin\Rak::index');
$routes->get('/pustakawan/rak/tambah', 'Admin\Rak::tambah');
$routes->get('/pustakawan/rak/ubah/(:any)', 'Admin\Rak::ubah/$1');
$routes->post('/pustakawan/rak/save', 'Admin\Rak::save');
$routes->post('/pustakawan/rak/update', 'Admin\Rak::update');
$routes->DELETE('/pustakawan/rak/delete/(:any)', 'Admin\Rak::delete/$1');

// Jenis Buku

$routes->get('/pustakawan/jenis', 'Admin\Jenis::index');
$routes->get('/pustakawan/jenis/tambah', 'Admin\Jenis::tambah');
$routes->get('/pustakawan/jenis/ubah/(:any)', 'Admin\Jenis::ubah/$1');
$routes->post('/pustakawan/jenis/save', 'Admin\Jenis::save');
$routes->post('/pustakawan/jenis/update', 'Admin\Jenis::update');
$routes->DELETE('/pustakawan/jenis/delete/(:any)', 'Admin\Jenis::delete/$1');

// Buku

$routes->get('/pustakawan/buku', 'Admin\Buku::index');
$routes->get('/pustakawan/buku/tambah', 'Admin\Buku::tambah');
$routes->get('/pustakawan/buku/ubah', 'Admin\Buku::ubah');

// Peminjaman

$routes->get('/pustakawan/peminjaman', 'Admin\Peminjaman::index');
$routes->get('/pustakawan/pengembalian', 'Admin\Pengembalian::index');
// $routes->get('/pustakawan/buku/tambah', 'Admin\Buku::tambah');
// $routes->get('/pustakawan/buku/ubah', 'Admin\Buku::ubah');

// DENDA

$routes->get('/pustakawan/denda', 'Admin\Denda::index');
$routes->get('/pustakawan/denda/tambah', 'Admin\Denda::tambah');
$routes->get('/pustakawan/denda/ubah', 'Admin\Denda::ubah');

// LAPORAN

$routes->get('/pustakawan/laporan', 'Admin\Laporan::index');
// $routes->get('/pustakawan/denda/tambah', 'Admin\Denda::tambah');
// $routes->get('/pustakawan/denda/ubah', 'Admin\Denda::ubah');

// SEKOLAH

$routes->get('/pustakawan/sekolah', 'Admin\Sekolah::index');

// SEKOLAH

$routes->get('/pustakawan/perpustakaan', 'Admin\Perpustakaan::index');

// WHASTAPP

$routes->get('/pustakawan/whastapp', 'Admin\Whastapp::index');

// EMAIL

$routes->get('/pustakawan/email', 'Admin\Email::index');
$routes->post('/pustakawan/email/save', 'Admin\Email::save');

// PROFIL

$routes->get('/pustakawan/profil', 'Admin\Profil::index');
$routes->get('/pustakawan/password', 'Admin\Profil::password');

// USERS

$routes->get('/pustakawan/user', 'Admin\Users::index');
$routes->get('/pustakawan/user/tambah', 'Admin\Users::tambah');
$routes->get('/pustakawan/user/ubah', 'Admin\Users::ubah');

// USERS

$routes->get('/pustakawan/pengajuan', 'Admin\Pengajuan::index');
// $routes->get('/pustakawan/user/tambah', 'Admin\Users::tambah');
// $routes->get('/pustakawan/user/ubah', 'Admin\Users::ubah');