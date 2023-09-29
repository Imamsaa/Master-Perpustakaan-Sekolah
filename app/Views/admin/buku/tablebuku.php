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
            <h1 class="m-0">Data Buku</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item">Buku</li>
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
                    <h3>DAFTAR BUKU</h3>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row my-2">
                    <div class="col-lg-6">
                    <a href="<?= base_url('pustakawan/buku/tambah'); ?>" class="btn btn-primary my-1"><i class="fas fa-solid fa-plus"></i> TAMBAHKAN BUKU</a>
                    <button type="button" class="btn btn-success my-1"><i class="fas fa-solid fa-arrow-down"></i> UNDUH EXCEL</button>
                  </div>
                    <div class="col-lg-4">
                    <form action="<?= base_url('pustakawan/excel/buku'); ?>" method="post" id="excel-buku" enctype="multipart/form-data" class="d-inline">
                      <div class="custom-file my-1">
                        <input name="buku" type="file" class="custom-file-input" id="buku">
                        <label class="custom-file-label" for="buku">Pilih file Excel</label>
                      </div>
                    </form>
                    </div>
                    <div class="col-lg-2">
                      <button form="excel-buku" type="submit" class="btn btn-block btn-success my-1"><i class="fas fa-solid fa-arrow-up"></i> IMPOR EXCEL</button>
                    </div>
                  </div>
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>JUDUL</th>
                    <th>STOK</th>
                    <th>RAK BUKU</th>
                    <th>JENIS BUKU</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no =1; foreach($buku as $row) :  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row['judul_buku']; ?></td>
                    <td><?= $row['stok']; ?></td>
                    <td><?= $row['nama_rak']; ?></td>
                    <td><?= $row['nama_jenis']; ?></td>
                    <td>
                        <a href="<?= base_url('pustakawan/buku/ubah/'.$row['slug']); ?>" class="btn btn-primary mb-1" ><i class="fas fa-solid fa-pen"></i></a>
                        <form action="<?= base_url('pustakawan/buku/delete/'.$row['slug']); ?>" method="post" class="d-inline">
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" class="btn btn-danger mb-1" ><i class="fas fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                  </tr>
                  <?php $no++; endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>NO</th>
                    <th>JUDUL</th>
                    <th>STOK</th>
                    <th>RAK BUKU</th>
                    <th>JENIS BUKU</th>
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