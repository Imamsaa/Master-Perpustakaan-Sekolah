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
