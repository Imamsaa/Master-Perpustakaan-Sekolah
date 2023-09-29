<?= $this->extend('template'); ?>
<?= $this->section('tampilan'); ?>
<div class="col-md-7 mt-5">
    <div class="col-md-6 text-white text-center text-md-left mt-xl-5 mx-auto" >
        <div class="text-center">
            <img class="mx-auto d-block" src="admin/img/<?= $sekolah['logo']; ?>" width="140px"> 
        </div>    
        <h1 class="h1-responsive text-center font-weight-bold mt-sm-2">SELAMAT DATANG DI<br><?= $perpus['nama_perpus']; ?><br><?= $sekolah['nama_sekolah']; ?></h1>
        <hr style="background-color: #ffffff; ">
        <form action="" method="post">
            <input type="text" class="p-2 mb-1 form-control" placeholder="Masukan NIS" name="nis" id="nis">    
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('form'); ?>
<div class="col-md-5 d-none d-md-flex bg-login">
    <div class="login d-flex align-items-center py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 mx-auto">
                    <h1 class="h1-responsive text-center text-white font-weight-bold mb-4">DATA SISWA</h1>
                        <div class="col-md-12">
                            <img class="img-thumbnail" src="admin/img/siswa/siswa_default.jpg" alt="">
                        </div>
                        <div class="col-md-12">
                            <table class="table bg-white rounded table-sm table-borderless my-1">
                                <tr>
                                    <td class="">NIS</td>
                                    <td class="">: 2121</td>
                                </tr>
                                <tr>
                                    <td class="">NAMA</td>
                                    <td class="">: IMAM SAFII</td>
                                </tr>
                                <tr>
                                    <td class="">KELAS</td>
                                    <td class="">: X IPA 2</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">2022-9-12</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- End -->

        </div>
    </div>
</div>
<?= $this->endSection(); ?>