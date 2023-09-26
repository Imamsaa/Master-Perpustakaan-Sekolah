<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="row container-fluid d-flex justify-content-start align-items-center" style="height: 100vh;">
    <!-- Bagian pertama (sebelah kiri) -->
    <div class="col-md-8">
        <!-- Header dan Logo -->
        <div class="text-center">
            <img src="<?= base_url('admin/img/'.$sekolah['logo']); ?>" alt="<?= $sekolah['nama_sekolah']; ?>" class="img-fluid" style="max-width: 120px; max-height: 120px;">
            <div class="my-4"></div>
            <span class="logo-text" style="font-size: 42px; font-weight: bold; color: white; font-family: 'Arial', sans-serif;"><?= $sekolah['nama_sekolah']; ?></span>
        </div>
        <!-- Input teks -->
        <!-- <div class="input-container text-center">
            <input type="text" class="form-control rounded-input mx-auto" placeholder="Tuliskan sesuatu..." style="font-size: 14px; padding: 15px; width: 80%; border-radius: 25px;">
        </div> -->
        <!-- Menu Link Horizontal (Bootstrap) -->
        <?= $this->include('menu'); ?>
    </div>
    <!-- Bagian kedua (sebelah kanan) -->
    <div class="col-md-4 d-flex justify-content-center align-items-center" style="background-color: rgba(255, 255, 255, 1); width: 33%; height: 100vh; position: fixed; right: 0; overflow-y: scroll; padding: 20px;">
        <div class="container container-img">
            <h2 class="table-heading text-center mb-3">Peminjaman Buku</h2>
            <form>
                <div class="mb-3">
                    <label for="username" class="form-label">Kode Buku</label>
                    <input type="text" class="form-control" id="username" placeholder="Masukkan username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kode Siswa</label>
                    <input type="text" class="form-control" id="password" placeholder="Masukkan password" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary login-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>