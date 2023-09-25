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
            
          <div class="col-lg-8 col-sm-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                    <h3>TABEL PENGEMBALIAN</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example1" class="table table-sm table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>KODE BUKU</th>
                    <th>TANGGAL</th>
                    <th>KETERLAMBATAN</th>
                    <th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach($kembali as $k) : ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $k['nis']; ?></td>
                    <td><?= $k['kode_buku']; ?></td>
                    <td><?= $k['pinjam']; ?></td>
                    <td><?= $k['terlambat']; ?></td>
                    <td>
                        <a href="<?= base_url('pustakawan/pengembalian/'.$k['id']); ?>" class="btn btn-sm btn-primary <?= (isset($peminjam['id']) AND $k['id'] == $peminjam['id']) ? 'disabled' : ''; ?> " >Pengembalian <i class="fas fa-solid fa-arrow-right"></i></button>
                    </td>
                  </tr>
                  <?php $no++; endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>NO</th>
                    <th>NIS</th>
                    <th>KODE BUKU</th>
                    <th>TANGGAL</th>
                    <th>KETERLAMBATAN</th>
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
          <div class="col-lg-4 col-sm-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">
                    <h3> DATA PENGEMBALIAN</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php if(isset($peminjam)) : ?>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <td><b>Terlambat :</b><br><?= $terlambat.' Hari'; ?></td>
                        <td><b>Denda :</b><br><?= $denda; ?></td>
                      </tr>
                      <tr>
                        <th colspan="2" class="text-center">DATA BUKU</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center"><img width="100" class="img-thumbnail" src="<?= base_url('admin/img/buku/'.$peminjam['sampul']); ?>" alt="COVER BUKU"></td>
                        <td>
                          <b>Judul :</b> <br>
                          <?= $peminjam['judul_buku']; ?><br>
                          <b>Kode Buku :</b> <br>
                          <?= $peminjam['kode_buku']; ?>
                        </td>
                      </tr>
                      <tr>
                        <th colspan="2" class="text-center">DATA SISWA</th>
                      </tr>
                      <tr>
                        <td class="text-center"><img width="100" class="img-thumbnail" src="<?= base_url('admin/img/siswa/'.$peminjam['foto']); ?>" alt="FOTO SISWA"></td>
                        <td>
                          <b>Nama : </b> <br>
                          <?= $peminjam['nama_siswa']; ?><br>
                          <b>NIS :</b> <br>
                          <?= $peminjam['nis']; ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                <?php else : ?>
                  <h3 class="text-center">TIDAK ADA DATA</h3>
                <?php endif; ?>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              <?php if(isset($peminjam)) : ?>
                  <form action="<?= base_url('pustakawan/pengembalian/update'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $peminjam['id']; ?>">
                    <input type="hidden" name="terlambat" value="<?= $terlambat; ?>">
                    <input type="hidden" name="denda" value="<?= $denda; ?>">
              <?php endif; ?>
                    <button type="submit" class="btn btn-primary btn-block my-1">SUBMIT</button>
                  </form>
                  <a href="<?= base_url('pustakawan/pengembalian'); ?>" class="btn btn-danger btn-block my-1">BATAL</a>
              </div>
            </div>
            <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?= $this->endSection(); ?>