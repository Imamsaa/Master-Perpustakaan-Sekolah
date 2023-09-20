<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url('admin/img/sekolah.png'); ?>" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('admin/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <style>
    @page { size: A4 }
  
    body{
        background-color:#303030;
        font-family: "Times New Roman", Times, serif;
    }

    h1 {
        font-weight: bold;
        font-size: 20pt;
        text-align: center;
    }
  
    .text-center {
        text-align: center;
    }

    .kartu{
        width: 8.56cm;
        height: 5.398cm;
        border: 5px solid black;
    }
    </style>
</head>
<body class="A4">
    <section class="sheet padding-10mm">
        <div class="row my-1">
            <div class="kartu mx-1">

            </div>
            <div class="kartu mx-1">

            </div>
        </div>
        <div class="row my-1">
            <div class="kartu mx-1">

            </div>
            <div class="kartu mx-1">

            </div>
        </div>
        <div class="row my-1">
            <div class="kartu mx-1">

            </div>
            <div class="kartu mx-1">

            </div>
        </div>
    </section>
</body>
</html>
<script>
    setTimeout(function () { window.print(); }, 500);
    window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
</script>