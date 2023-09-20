<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// DASHBOARD

$routes->get('/pustakawan', 'Admin\Dashboard::index');

// KELAS

$routes->get('/pustakawan/kelas', 'Admin\Kelas::index');
$routes->get('/pustakawan/kelas/tambah', 'Admin\Kelas::tambah');
$routes->get('/pustakawan/kelas/ubah', 'Admin\Kelas::ubah');

// SISWA

$routes->get('/pustakawan/siswa', 'Admin\Siswa::index');
$routes->get('/pustakawan/siswa/tambah', 'Admin\Siswa::tambah');
$routes->get('/pustakawan/siswa/ubah', 'Admin\Siswa::ubah');

// TAHUN

$routes->get('/pustakawan/tahun', 'Admin\Tahun::index');
$routes->get('/pustakawan/tahun/tambah', 'Admin\Tahun::tambah');
$routes->get('/pustakawan/tahun/ubah', 'Admin\Tahun::ubah');

// CETAK

$routes->get('/pustakawan/siswa/cetak', 'Admin\Cetak::index');
$routes->get('/pustakawan/buku/cetak', 'Admin\Cetak::buku');
$routes->get('/pustakawan/siswa/cetak/ya', 'Admin\Cetak::cetak');
$routes->get('/pustakawan/buku/cetak/ya', 'Admin\Cetak::barcode');

// PENERBIT

$routes->get('/pustakawan/penerbit', 'Admin\Penerbit::index');
$routes->get('/pustakawan/penerbit/tambah', 'Admin\Penerbit::tambah');
$routes->get('/pustakawan/penerbit/ubah', 'Admin\Penerbit::ubah');

// Rak Buku

$routes->get('/pustakawan/rak', 'Admin\Rak::index');
$routes->get('/pustakawan/rak/tambah', 'Admin\Rak::tambah');
$routes->get('/pustakawan/rak/ubah', 'Admin\Rak::ubah');

// Rak Buku

$routes->get('/pustakawan/jenis', 'Admin\Jenis::index');
$routes->get('/pustakawan/jenis/tambah', 'Admin\Jenis::tambah');
$routes->get('/pustakawan/jenis/ubah', 'Admin\Jenis::ubah');

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