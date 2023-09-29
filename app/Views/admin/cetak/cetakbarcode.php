<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('dist/css/bootstrap.min.css'); ?>">
    <link rel="shortcut icon" href="<?= base_url('admin/img/sekolah.png'); ?>" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <style>
    .kartu{
        display: inline-block;
        width: 7cm;
        height: 4cm;
        border: 2px solid black;
    }
    td{
        font-size : 13px;
    }
    .barcode{
        transform : scaleY(0.4) scaleX(1.5) rotate(90deg) translate(10px,-5px);
    }
    </style>
</head>
<body>
    <section class="mx-2">
        <?php foreach ($buku as $c) : ?>
            <div class="kartu mx-1 my-1">
                <div class="row">
                    <div class="col-3">
                        <div class="barcode">
                            <?= $c['barcode_buku']; ?>
                        </div>
                    </div>
                    <div class="col-9">
                        <table class="table table-borderless">
                            <tr>
                                <th class="text-center" style="background-color:<?= $c['kode_warna']; ?>"><?= $sekolah['nama_sekolah']; ?></th>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <?= $c['judul_buku']; ?><br>
                                    <?= $c['nama_jenis']; ?><br>
                                    <?= $c['nama_rak']; ?><br>
                                    <?= $c['kode_buku']; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</body>
</html>
<script>
    setTimeout(function () { window.print(); }, 500);
    window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
</script>