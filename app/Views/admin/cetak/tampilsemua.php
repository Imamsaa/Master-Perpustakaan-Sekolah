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
            <h1 class="m-0">Cetak kartu Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan/siswa'); ?>">Siswa</a></li>
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
                    <h3>DAFTAR CETAK KARTU SISWA</h3>
                    <a href="<?= base_url('pustakawan/siswa/cetaksiswa'); ?>" class="btn btn-primary my-1">TAMPILKAN SEMUA</a>
                    <a href="<?= base_url('pustakawan/siswa/cetakkelas'); ?>" class="btn btn-primary my-1">TAMPILKAN PERKELAS</a>
                    <a target="_blank" href="<?= base_url('pustakawan/cetak/siswa'); ?>" class="btn btn-primary my-1">CETAK SEMUA</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>NAMA SISWA</th>
                    <th>KELAS</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach($siswa as $s) : ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $s['nis']; ?></td>
                    <td><?= $s['nama_siswa']; ?></td>
                    <td><?= $s['nama_kelas']; ?></td>
                    <td>
                        <a target="_blank" href="<?= base_url('pustakawan/cetak/siswa/'.$s['nis']); ?>" class="btn btn-primary my-1" ><i class="fas fa-solid fa-print"></i> Cetak Kartu</a>
                    </td>
                  </tr>
                  <?php $no++; endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>NAMA SISWA</th>
                    <th>KELAS</th>
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