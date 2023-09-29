<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url('admin/img/'.$sekolah['logo']); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('dist/css/bootstrap.min.css'); ?>" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .login,
.image {
  min-height: 100vh;
}

.bg-image {
  background-image: url("<?= base_url('img/'.$sekolah['background']) ?>");
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
}

.bg-login{
    background-color : rgb(255,255,255,0.2);
}

.bg-nav{
    background-color : rgb(255,255,255,0.0);
}
    </style>    
</head>
<body class="">