<?= $this->extend('template'); ?>
<?= $this->section('tampilan'); ?>
<div class="col-md-7 mt-5 d-none d-md-flex">
    <div class="col-md-6 text-white text-center text-md-left mt-xl-5 mb-3 mx-auto" >
        <div class="text-center mt-5">
            <img class="mx-auto d-block" src="admin/img/<?= $sekolah['logo']; ?>" width="140px"> 
        </div>    
        <h1 class="h1-responsive text-center font-weight-bold mt-sm-2">SELAMAT DATANG DI<br><?= $perpus['nama_perpus']; ?><br><?= $sekolah['nama_sekolah']; ?></h1>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('form'); ?>
<div class="col-md-5 bg-login">
    <div class="login d-flex align-items-center py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 card col-xl-7 mx-auto">
                    <div class="card-body">
                        <h2 class="h2-responsive card-title text-center font-weight-bold mb-5">FORM PEMINJAMAN</h2> 
                        <form action="<?= base_url('setpeminjaman'); ?>" method="POST">
                            <div class="form-control mb-3">
                                <input id="nis" name="nis" type="text" placeholder="NIS SISWA" required="" class="form-control rounded-pill border-0 shadow-sm px-4">
                            </div>
                            <div class="form-control mb-3">
                                <input id="kode_buku" name="kode_buku" type="text" placeholder="KODE BUKU" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">PINJAM</button>       
                        </form>
                    </div>       
                </div>
            </div>
        </div><!-- End -->
    </div>
</div>
<?= $this->endSection(); ?>