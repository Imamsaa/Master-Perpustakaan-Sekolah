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
            <h1 class="m-0">Ubah Penerbit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan/penerbit'); ?>">Penerbit</a></li>
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
        <div class="row mb-2">
            <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                    <h3>Ubah Penerbit</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('pustakawan/penerbit/update'); ?>" method="POST">
              <?= csrf_field(); ?>
                <div class="card-body">
                  <div class="form-group">
                      <label for="kode_penerbit">Kode Penerbit</label>
                      <input type="text" value="<?= (old('kode_penerbit')) ? old('kode_penerbit') : $penerbit['kode_penerbit']; ?>" name="kode_penerbit" class="form-control" id="kode_penerbit" placeholder="" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama_penerbit">Nama Penerbit</label>
                    <input type="text" value="<?= (old('nama_penerbit')) ? old('nama_penerbit') : $penerbit['nama_penerbit']; ?>" name="nama_penerbit" class="form-control" id="nama_penerbit" placeholder="">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary my-1"><i class="fas fa-solid fa-pen"></i> Ubah Penerbit</button>
                  <a href="<?= base_url('pustakawan/penerbit'); ?>" class="btn btn-danger my-1"><i class="fas fa-solid fa-ban"></i> Batal</a>
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