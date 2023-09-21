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
            <h1 class="m-0">Pengembalian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item">Pengembalian</li>
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
            <div class="col-4">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                    <h3>PENGEMBALIAN</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                      <label for="kodebuku">Scan Barcode Buku</label>
                      <input type="text" name="kodebuku" class="form-control" id="kodebuku" placeholder="">
                </div>
                <div class="form-group">
                      <label for="kodesiswa">Scan Barcode Siswa</label>
                      <input type="text" name="kodesiswa" class="form-control" id="kodesiswa" placeholder="">
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block my-1">Submit Pengembalian</button>
                </div>
            </div>
            <!-- /.card -->
            </div>
          <div class="col-8">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                    <h3>TABEL PENGEMBALIAN</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>NAMA SISWA</th>
                    <th>JUDUL BUKU</th>
                    <th>TANGGAL PINJAM</th>
                    <th>TANGGAL KEMBALI</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>1</td>
                    <td>Imam Safii</td>
                    <td>Lord Of The Rings</td>
                    <td>10:8:2023</td>
                    <td>12:8:2023</td>
                    <td>
                        <button type="button" class="btn btn-danger mb-1" ><i class="fas fa-solid fa-ban"> Batal</i></button>
                    </td>
                  </tr>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>NO</th>
                    <th>NAMA SISWA</th>
                    <th>JUDUL BUKU</th>
                    <th>TANGGAL PINJAM</th>
                    <th>TANGGAL KEMBALI</th>
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