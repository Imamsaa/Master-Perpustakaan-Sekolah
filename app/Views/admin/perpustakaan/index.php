<?= $this->extend('admin/template/template'); ?>
 <!-- Content Wrapper. Contains page content -->
 <?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profil Perpustakaan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item">Perpustakaan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                    <h3>Ubah Profil Perpustakaan</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('pustakawan/perpustakaan/save'); ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                      <label for="nama_perpus">Nama Perpustakaan</label>
                      <input type="text" value="<?= (old('nama_perpus')) ? old('nama_perpus') : $perpus['nama_perpus']; ?>" name="nama_perpus" class="form-control" id="nama_perpus" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="slogan_perpus">Slogan Perpustakaan</label>
                      <input type="text" value="<?= (old('slogan_perpus')) ? old('slogan_perpus') : $perpus['slogan_perpus']; ?>" name="slogan_perpus" class="form-control" id="slogan_perpus" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="peraturan_perpus">Peraturan Perpustakaan (Optional)</label>
                    <textarea name="peraturan_perpus" class="form-control" id="peraturan_perpus" rows="3"><?= (old('peraturan_perpus')) ? old('peraturan_perpus') : $perpus['peraturan_perpus']; ?></textarea>
                  </div>
                  <!-- <div class="form-group">
                    <label for="email">Email Sekolah</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat Sekolah</label>
                    <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
                  </div> -->
                  <!-- <div class="form-group">
                    <label for="nisn">NISN Siswa</label>
                    <input type="text" name="nisn" class="form-control" id="nisn" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Siswa</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="kelas">Pilih Kelas</label>
                      <select id="kelas" name="kelas" class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tahun">Pilih Tahun Ajaran</label>
                      <select id="tahun" name="tahun" class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                  <div class="form-group">
                    <label for="nomorwa">Nomor WhastApp</label>
                    <input type="text" name="nomorwa" class="form-control" id="nomorwa" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="email">Email Siswa</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat Siswa</label>
                    <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary my-1"><i class="fas fa-solid fa-pen"></i> Ubah Profil Perpustakaan</button>
                  <a href="<?= base_url('pustakawan/perpustakaan'); ?>" class="btn btn-danger my-1"><i class="fas fa-solid fa-ban"></i> Batal</a>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?= $this->endSection(); ?>