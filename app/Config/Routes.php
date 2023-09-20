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
$routes->get('/pustakawan/siswa/cetak/ya', 'Admin\Cetak::cetak');

// PENERBIT

$routes->get('/pustakawan/penerbit', 'Admin\Penerbit::index');
$routes->get('/pustakawan/penerbit/tambah', 'Admin\Penerbit::tambah');
$routes->get('/pustakawan/penerbit/ubah', 'Admin\Penerbit::ubah');