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
            <h1 class="m-0">Ubah Tahun Ajaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan/tahun'); ?>">Tahun</a></li>
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
                    <h3>Ubah Tahun Ajaran</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('pustakawan/tahun/update'); ?>" method="post">
              <?= csrf_field(); ?>  
              <div class="card-body">
                <div class="form-group">
                      <label for="kode_tahun">Kode Tahun</label>
                      <input type="text" value="<?= (old('kode_tahun')) ? old('kode_tahun') : $tahun['kode_tahun']; ?>" name="kode_tahun" class="form-control" id="kode_tahun" placeholder="" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama_tahun">Nama Tahun</label>
                    <input type="text" value="<?= (old('nama_tahun')) ? old('nama_tahun') : $tahun['nama_tahun']; ?>" name="nama_tahun" class="form-control" id="nama_tahun" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="aktif">Mulai Aktif</label>
                    <input type="date" value="<?= (old('aktif')) ? old('aktif') : date('Y-m-d', strtotime($tahun['aktif'])); ?>" name="aktif" class="form-control" id="aktif" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="kadaluarsa">Kadaluarsa Pada</label>
                    <input type="date" value="<?= (old('kadaluarsa')) ? old('kadaluarsa') : date('Y-m-d', strtotime($tahun['kadaluarsa'])); ?>" name="kadaluarsa" class="form-control" id="kadaluarsa" placeholder="">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary my-1"><i class="fas fa-solid fa-pen"></i> Ubah Tahun</button>
                  <a href="<?= base_url('pustakawan/tahun'); ?>" class="btn btn-danger my-1"><i class="fas fa-solid fa-ban"></i> Batal</a>
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