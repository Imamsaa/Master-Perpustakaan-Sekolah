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
            <h1 class="m-0">Ubah Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item">Password</li>
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
                    <h3>Ubah Password Pustakawan</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('pustakawan/password/update'); ?>" method="post">
              <?= csrf_field(); ?>
                <div class="card-body">
                  <!-- <div class="row mb-2">
                    <div class="col-md-3 my-2 col-sm-12">
                      <img src="" alt="Foto Siswa" class="img-thumbnail">
                    </div> -->
                  <!-- <div class="form-group">
                      <label for="nis">NIS Siswa</label>
                      <input type="text" name="nis" class="form-control" id="nis" placeholder="" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nisn">NISN Siswa</label>
                    <input type="text" name="nisn" class="form-control" id="nisn" placeholder="">
                  </div> -->
                  <div class="form-group">
                    <label for="password">Masukan Password Lama</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="pw1">Masukan Password Baru</label>
                    <input type="password" name="pw1" class="form-control" id="pw1" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="pw2">Masukan Ulang Password Baru</label>
                    <input type="password" name="pw2" class="form-control" id="pw2" placeholder="">
                  </div>
                  <!-- <div class="form-group">
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
                    </div> -->
                  <!-- <div class="form-group">
                    <label for="nomorwa">Nomor WhastApp</label>
                    <input type="text" name="nomorwa" class="form-control" id="nomorwa" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="email">Email Pustakawan</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat Pustakawan</label>
                    <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
                  </div>
                </div> -->
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary my-1"><i class="fas fa-solid fa-pen"></i> Ubah Password</button>
                  <a href="<?= base_url('pustakawan'); ?>" class="btn btn-danger my-1"><i class="fas fa-solid fa-ban"></i> Batal</a>
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