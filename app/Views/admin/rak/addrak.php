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
            <h1 class="m-0">Tambah Rak Buku</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan/rak'); ?>">Rak Buku</a></li>
              <li class="breadcrumb-item">Tambah</li>
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
        <div class="row mb-2">
            <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <div class="card-title">
                    <h3>Tambahkan Rak Buku</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('pustakawan/rak/save'); ?>" method="POST">
              <?= csrf_field(); ?>
                <div class="card-body">
                  <div class="form-group">
                      <label for="kode_rak">Kode Rak Buku</label>
                      <input type="text" value="<?= old('kode_rak'); ?>" name="kode_rak" class="form-control" id="kode_rak" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="nama_rak">Nama Rak Buku</label>
                    <input type="text" value="<?= old('nama_rak'); ?>" name="nama_rak" class="form-control" id="nama_rak" placeholder="">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary my-1"><i class="fas fa-solid fa-plus"></i> Tambah Rak Buku</button>
                  <a href="<?= base_url('pustakawan/rak'); ?>" class="btn btn-danger my-1"><i class="fas fa-solid fa-ban"></i> Batal</a>
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