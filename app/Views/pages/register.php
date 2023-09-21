<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="row container-fluid d-flex justify-content-start align-items-center" style="height: 100vh;">
    <!-- Bagian pertama (sebelah kiri) -->
    <div class="col-md-8 col-sm-12">
        <!-- Header dan Logo -->
        <div class="text-center">
            <img src="<?= base_url('admin/img/sekolah.png'); ?>" alt="Logo SMAN 1 Wirosari" class="img-fluid" style="max-width: 120px; max-height: 120px;">
            <div class="my-4"></div>
            <span class="logo-text" style="font-size: 42px; font-weight: bold; color: white; font-family: 'Arial', sans-serif;">Perpustakaan SMAN 1 Wirosari</span>
        </div>
        <!-- Input teks -->
        <!-- <div class="input-container text-center">
            <input type="text" class="form-control rounded-input mx-auto" placeholder="Tuliskan sesuatu..." style="font-size: 14px; padding: 15px; width: 80%; border-radius: 25px;">
        </div> -->
        <!-- Menu Link Horizontal (Bootstrap) -->
        <?= $this->include('menu'); ?>
    </div>
    <!-- Bagian kedua (sebelah kanan) -->
    <div class="col-md-4 col-sm-12 d-flex justify-content-center align-items-center" style="background-color: rgba(255, 255, 255, 1); width: 33%; height: 100vh; position: fixed; right: 0; overflow-y: scroll; padding: 20px;">
        <div class="container container-img">
            <h2 class="table-heading text-center mb-3">Daftar Akun</h2>
            <form>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="mb-3">
                    <label for="whastapp" class="form-label">Nomor WhastApp</label>
                    <input type="text" class="form-control" id="whastapp" placeholder="Masukkan alamat email" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Masukkan alamat email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Masukkan password" required>
                </div>
                <div class="mb-3">
                    <label for="konfirmasiPassword" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="konfirmasiPassword" placeholder="Konfirmasi password" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary login-btn">Daftar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>