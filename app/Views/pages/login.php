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
                <div class="card col-lg-10 col-xl-7 mx-auto">
                    <div class="card-body">
                        <h2 class="text-center card-title mb-5 font-weight-bold">LOGIN PUSTAKAWAN</h2>
                        <form action="<?= base_url('setlogin'); ?>" method="POST">
                            <div class="form-control mb-3">
                                <input value="<?= old('email_user'); ?>" id="email_user" name="email_user" type="email" placeholder="Email address" required="" class="form-control rounded-pill border-0 shadow-sm px-4">
                            </div>
                            <div class="form-control mb-3">
                                <input id="password" name="password" type="password" placeholder="Password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Sign in</button>
                        </form>
                    </div>         
                </div>
            </div>
        </div><!-- End -->
    </div>
</div>
<?= $this->endSection(); ?>