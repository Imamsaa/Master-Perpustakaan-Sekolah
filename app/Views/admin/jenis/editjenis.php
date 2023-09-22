<?= $this->extend('admin/template/template'); ?>
 <!-- Content Wrapper. Contains page content -->
 <?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0">Ubah Jenis Buku</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan/jenis'); ?>">Jenis Buku</a></li>
              <li class="breadcrumb-item">Ubah</li>
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
                    <h3>Ubah Jenis Buku</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('pustakawan/jenis/update'); ?>" method="POST">
              <?= csrf_field(); ?>
                <div class="card-body">
                  <div class="form-group">
                      <label for="kode_jenis">Kode Jenis Buku</label>
                      <input type="text" value="<?= (old('kode_jenis')) ? old('kode_jenis') : $jenis['kode_jenis']; ?>" name="kode_jenis" class="form-control" id="kode_jenis" placeholder="" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama_jenis">Nama Jenis Buku</label>
                    <input type="text" value="<?= (old('nama_jenis')) ? old('nama_jenis') : $jenis['nama_jenis']; ?>" name="nama_jenis" class="form-control" id="nama_jenis" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="kode_warna">Kode Warna</label>
                    <input type="color" value="<?= (old('kode_warna')) ? old('kode_warna') : $jenis['kode_warna']; ?>" name="kode_warna" class="form-control col-md-3 mb-2" id="kode_warna" placeholder="">
                    <label for="kode_warna" class="label col-md-7">Kode warna digunakan sebagai penanda jenis buku pada barcode buku</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary my-1"><i class="fas fa-solid fa-pen"></i> Ubah Jenis Buku</button>
                  <a href="<?= base_url('pustakawan/jenis'); ?>" class="btn btn-danger my-1"><i class="fas fa-solid fa-ban"></i> Batal</a>
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