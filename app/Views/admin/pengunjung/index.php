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
            <h1 class="m-0">Laporan Pengunjung</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item">Laporan Pengunjung</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
            <div class="card border-success my-3" style="">
              <div class="card-body">
                <h3>Laporan Berdasarkan</h3>
                <form action="<?= base_url('pustakawan/pengunjung'); ?>" method="post" class="form-inline">
                  <label for="awal">Dari :</label>
                  <input type="date" id="awal" class="form-control my-1 mx-2" name="awal" id="awal">
                  <label id="labelakhir" for="awal">Sampai :</label>
                  <input type="date" class="form-control my-1 mx-2" name="akhir" id="akhir">
                  <input type="text" name="nis" class="form-control my-1 mx-2" id="nis" placeholder="NIS SISWA">
                  <input type="text" name="nama" id="nama" class="form-control my-1 mx-2" placeholder="NAMA SISWA">
                  <!-- <label for="awal">Kelas :</label> -->
                  <select name="kelas" class="form-control my-1 mx-2" id="kelas" placeholder="KELAS">
                    <option value="" selected hidden>KELAS</option>
                    <option value=""></option>
                    <?php foreach($kelas as $k) : ?>
                      <option value="<?= $k['kode_kelas']; ?>"><?= $k['nama_kelas']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <button type="submit" value="lapor" name="lapor" class="btn btn-success my-1 mx-2"><i class="fas fa-solid fa-search"></i> CARI</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                    <h3>Laporan Pengunjung</h3>
                    <!-- <a href="" class="btn save btn-primary my-1"><i class="fas fa-solid fa-arrow-right"></i> RESET LAPORAN</a> -->
                    <!-- <button type="button" class="btn btn-success my-1"><i class="fas fa-solid fa-arrow-down"></i> UNDUH EXCEL</button>
                    <button type="button" class="btn btn-success my-1"><i class="fas fa-solid fa-arrow-up"></i> IMPORT DATA DENDA</button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>NAMA</th>
                    <th>KELAS</th>
                    <th>WAKTU</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php $no = 1; foreach($lap as $l) : ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $l['nis']; ?></td>
                          <td><?= $l['nisn']; ?></td>
                          <td><?= $l['nama_siswa']; ?></td>
                          <td><?= $l['nama_kelas']; ?></td>
                          <td><?= $l['waktu']; ?></td>
                        </tr>
                        <?php $no++; endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>NAMA</th>
                    <th>KELAS</th>
                    <th>WAKTU</th>
                  </tr>
                  </tfoot>
                </table>
                  </div>
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