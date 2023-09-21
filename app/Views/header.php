<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url('admin/img/sekolah.png'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('dist/css/bootstrap.min.css'); ?>">
    <style>
        .container-img {
            width: 70%;
        }
        /* Menambahkan transparansi pada latar belakang menu */
        .navbar {
            background-color: rgba(0, 0, 0, 0.0) !important; /* Gunakan !important untuk mengatasi kekhususan Bootstrap */
        }
        /* Mengatur lebar tombol login */
        .login-btn {
            width: 100%;
        }
    </style>
</head>
<body style="background-image: url(<?= base_url('img/background_home.jpg'); ?>); background-size: cover; background-position: center; background-attachment: fixed; background-repeat: no-repeat; margin: 0; padding: 0; height: 100vh;">
