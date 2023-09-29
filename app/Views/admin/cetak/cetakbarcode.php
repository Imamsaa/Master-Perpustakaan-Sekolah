<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('dist/bootstrap5/css/bootstrap.min.css'); ?>">
    <link rel="shortcut icon" href="<?= base_url('admin/img/'.$sekolah['logo']); ?>" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <style>
    .kartu{
        display: inline-block;
        width: 7cm;
        height: 4.5cm;
        border: 2px solid black;
    }
    td{
        font-size : 13px;
    }
    .barcode{
        transform :rotate(90deg) scaleY(2) translate(0px, -5px);
        max-width : 40px 5px;
        padding : 7px;
    }
    </style>
</head>
<body>
    <section class="mx-2">
        <?php foreach ($buku as $c) : ?>
            <div class="kartu mx-1 my-1">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="barcode">
                            <?= $c['barcode_buku']; ?>
                        </div>
                    </div>
                    <div class="col-sm-9">
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