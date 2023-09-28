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
            <h1 class="m-0">Cetak Barcode</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan/buku'); ?>">Buku</a></li>
              <li class="breadcrumb-item">Cetak</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                    <h3>DAFTAR CETAK BARCODE BUKU</h3>
                    <a href="<?= base_url('pustakawan/buku/cetakbuku'); ?>" class="btn btn-primary my-1">TAMPILKAN SEMUA</a>
                    <a href="<?= base_url('pustakawan/buku/cetakrak'); ?>" class="btn btn-primary my-1">TAMPILKAN PERKELAS</a>
                    <a target="_blank" href="<?= base_url('pustakawan/cetak/buku'); ?>" class="btn btn-primary my-1">CETAK SEMUA</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>KODE RAK BUKU</th>
                    <th>RAK BUKU</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach($rak as $r) : ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $r['kode_rak']; ?></td>
                    <td><?= $r['nama_rak']; ?></td>
                    <td>
                        <a target="_blank" href="<?= base_url('pustakawan/cetak/rak/'.$r['kode_rak']); ?>" class="btn btn-primary mb-1" ><i class="fas fa-solid fa-print"></i> Cetak</a>
                        <a href="<?= base_url('pustakawan/buku/cetakbuku/'.$r['kode_rak']); ?>" class="btn btn-success mb-1" ><i class="fas fa-solid fa-arrow-right"> </i> Buka Rak Buku</a>
                    </td>
                  </tr>
                  <?php $no++; endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>NO</th>
                    <th>KODE RAK BUKU</th>
                    <th>RAK BUKU</th>
                    <th>ACTION</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?= $this->endSection(); ?>