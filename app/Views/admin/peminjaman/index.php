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
            <h1 class="m-0">Peminjaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item">Peminjaman</li>
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
            <div class="col-lg-3 col-sm-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                    <h3>PEMINJAMAN</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <form action="<?= base_url('pustakawan/peminjaman/save'); ?>" method="post">
              <div class="card-body">
                  <div class="form-group">
                    <label for="kode_buku">Barcode/Kode Buku</label>
                    <input type="text" name="kode_buku" class="form-control" id="kode_buku" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="nis">Barcode/NIS Siswa</label>
                    <input type="text" name="nis" class="form-control" id="nis" placeholder="">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block my-1">PINJAM</button>
                </div>
              </div>
            </form>
            <!-- /.card -->
            </div>
          <div class="col-lg-9 col-sm-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                    <h3>TABEL PEMINJAMAN</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="table-responsive card-body">
                <table id="example1" class="table table-sm table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>NAMA</th>
                    <th>KODE</th>
                    <th>JUDUL</th>
                    <th>PINJAM</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no = 1; foreach($pinjam as $p) : ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $p['nis']; ?></td>
                    <td><?= $p['nama_siswa']; ?></td>
                    <td><?= $p['kode_buku']; ?></td>
                    <td><?= $p['judul_buku']; ?></td>
                    <td><?= $p['pinjam']; ?></td>
                    <td class="text-center">
                      <form action="<?= base_url('pustakawan/peminjaman/delete/'.$p['id']); ?>" method="post" class="d-inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-sm btn-danger" ><i class="fas fa-solid fa-ban"> Batal</i></button>
                      </form>
                    </td>
                  </tr>
                  <?php $no++; endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>NAMA</th>
                    <th>KODE</th>
                    <th>JUDUL</th>
                    <th>PINJAM</th>
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