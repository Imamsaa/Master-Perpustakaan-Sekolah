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
        width: 8.56cm;
        height: 5.398cm;
        border: 2px solid black;
        border-radius: 15px;
        break-inside : avoid;
    }
    img{
        width : 40px;
    }
    h6{
        font-size : 12px;
    }
    td{
        font-size : 12px;
    }
    .sekolah{
        font-size: 16px;
    }
    .img-siswa{
        width : 70px;
    }
    .barcode{
        height: 10px;
    }
    </style>
</head>
<body>
    <section class="mx-2">
        <?php foreach ($cetak as $c) : ?>
        <div class="row mt-3 mb-1">
            <div class="kartu row mx-1">
                <table class="table my-0 table-borderless">
                    <!-- <tr>
                        <th><img class="img-thumbnail" src="/admin/img/<?= $sekolah['logo']; ?>" alt="Logo Sekolah"></th>
                        <th>
                            <h6 class="my-0 text-center">KARTU ANGGOTA PERPUSTAKAAN <?= $perpus['nama_perpus']; ?></h6>
                            <p class="sekolah my-0 text-center"><?= $sekolah['nama_sekolah']; ?></p>
                        </th>
                    </tr> -->
                </table>
                <hr class="my-1">
                <table class="table my-0 table-sm table-borderless">
                    <tr>
                        <td rowspan="3" ><img class="img-siswa" src="/admin/img/siswa/<?= $c['foto']; ?>" alt=""></td>
                        <td>NIS</td>
                        <td>: <?= $c['nis']; ?></td>
                    </tr>
                    <tr>
                        <td>NAMA</td>
                        <td>: <?= $c['nama_siswa']; ?></td>
                    </tr>
                    <tr>
                        <td>KELAS</td>
                        <td>: <?= $c['nama_kelas']; ?></td>
                    </tr>
                    <tr>
                        <td>Berlaku Sampai : <br>
                        <?= $c['kadaluarsa']; ?>
                    </td>
                    <td colspan="2">
                        <div class="barcode">
                            <?= $c['barcode_siswa']; ?></td>
                        </div>
                    </tr>
                </table>
            </div>
            <div class="kartu mx-1">
                <table class="table mt-1 mb-0 table-borderless">
                    <tr>
                        <th>
                            <h6 class="mb-0 text-center">KARTU ANGGOTA PERPUSTAKAAN</h6>
                            <p class="sekolah mb-0 text-center"><?= $sekolah['nama_sekolah']; ?></p>
                        </th>
                    </tr>
                </table>
                <hr class="my-1">
                <table class="table mt-1 mb-0 table-borderless">
                    <tr>
                        <td>
                            <p class="mb-0"><?= $perpus['peraturan_perpus']; ?></p>
                        </td>
                    </tr>
                </table>
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