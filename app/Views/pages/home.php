<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>
<div class="row container-fluid d-flex justify-content-start align-items-center" style="height: 100vh;">
    <!-- Bagian pertama (sebelah kiri) -->
    <div class="col-md-8">
        <!-- Header dan Logo -->
        <div class="text-center">
            <img src="<?= base_url('admin/img/sekolah.png'); ?>" alt="Logo SMAN 1 Wirosari" class="img-fluid" style="max-width: 120px; max-height: 120px;">
            <div class="my-4"></div>
            <span class="logo-text" style="font-size: 42px; font-weight: bold; color: white; font-family: 'Arial', sans-serif;">Perpustakaan SMAN 1 Wirosari</span>
        </div>
        <!-- Input teks -->
        <div class="input-container text-center">
            <input type="text" class="form-control rounded-input mx-auto" placeholder="Masukan NIS atau Scan Barcode" style="font-size: 14px; padding: 15px; width: 80%; border-radius: 25px;">
        </div>
        <!-- Menu Link Horizontal (Bootstrap) -->
        <?= $this->include('menu'); ?>
    </div>
    <!-- Bagian kedua (sebelah kanan) -->
    <div class="col-md-4" style="background-color: rgba(255, 255, 255, 1); width: 33%; height: 100vh; position: fixed; right: 0; overflow-y: scroll; padding: 20px;">
        <div class="container container-img">
            <h2 class="table-heading text-center">Data Diri Siswa</h2>
            <div class="row text-center">
                <div class="col-md-12">
                    <img class="img-thumbnail img-fluid" src="<?= base_url('admin/img/siswa_default.jpg'); ?>" alt="Foto Siswa">
                </div>
            </div>
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Nama</th>
                    <td class="student-details"></td>
                </tr>
                <tr>
                    <th>NIS</th>
                    <td class="student-details"></td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td class="student-details"></td>
                </tr>
                <tr>
                    <th>Waktu</th>
                    <td class="student-details"></td>
                </tr>
                <!-- Anda dapat menambahkan data siswa lainnya di sini -->
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>