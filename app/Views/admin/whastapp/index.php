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
            <h1 class="m-0">Atur Pesan WhastApp</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item">Pesan WhastApp</li>
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
                <p class="card-text">Untuk Mendapatkan <span class="text-danger font-weight-bold">APIKEY</span> dan link <span class="text-danger font-weight-bold">ENDPOINT</span> server Gateway WhastApp silahkan untuk mendaftar pada <a href="https://watsap.id/">https://watsap.id</a></p>
              </div>
            </div>
          </div>
        </div>
        <!-- ROW -->
        <div class="row">
            <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                    <h3>Atur Pesan WhastApp</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('pustakawan/whastapp/save'); ?>" method="POST">
              <?= csrf_field(); ?>
                <div class="card-body">
                <div class="form-group">
                      <label for="apikey">APIKEY Gateway WhastApp</label>
                      <input type="text" value="<?= (old('apikey')) ? old('apikey') : $whastapp['apikey']; ?>" name="apikey" class="form-control" id="apikey" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="endpoint">Link Endpoint</label>
                      <input type="text" value="<?= (old('endpoint')) ? old('endpoint') : $whastapp['endpoint']; ?>" name="endpoint" class="form-control" id="endpoint" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="pengirim">Nomor Pengirim</label>
                      <input type="text" value="<?= (old('pengirim')) ? old('pengirim') : $whastapp['pengirim']; ?>" name="pengirim" class="form-control" id="pengirim" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="selector">Selector Pesan</label>
                      <select id="selector" name="selector" class="form-control">
                        <?php foreach($selector as $s) : ?>
                        <option value="<?= $s['selector']; ?>" <?= ($s['selector'] == $whastapp['selector']) ? 'selected' : ''; ?>><?= $s['selector']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  <div class="form-group">
                    <label for="message">Isi Pesan</label>
                    <textarea name="message" class="form-control" id="message" rows="10"><?= (old('message')) ? old('message') : $whastapp['message']; ?></textarea>
                  </div>
                  <div class="form-group">
                      <div class="card border-success my-3" style="">
                        <div class="card-body">
                          <p class="card-text">
                            <b>ELEMENT DINAMIS</b><br>
                            Anda dapat menggunakan <span class="text-danger">TAB</span> dan Elemen dinamis pada pesan,<br>
                            Elemen dinamis adalah elemen yang akan diganti dengan data siswa ketika pesan dikirim.</p>
                            <table class="table table-sm table-bordered">
                                <tr>
                                  <td>ELEMENT DINAMIS</td>
                                  <td>DATA DARI DATABASE</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $whastapp['selector']; ?>nis<?= $whastapp['selector']; ?></span></td>
                                  <td>NIS Siswa</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $whastapp['selector']; ?>nisn<?= $whastapp['selector']; ?></span></td>
                                  <td>NISN Siswa</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $whastapp['selector']; ?>nama_siswa<?= $whastapp['selector']; ?></span></td>
                                  <td>Nama Siswa</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $whastapp['selector']; ?>nama_kelas<?= $whastapp['selector']; ?></span></td>
                                  <td>Kelas Siswa</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $whastapp['selector']; ?>kode_buku<?= $whastapp['selector']; ?></span></td>
                                  <td>Kode Buku Yang Dipinjam</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $whastapp['selector']; ?>judul_buku<?= $whastapp['selector']; ?></span></td>
                                  <td>Judul Buku Yang Dipinjam</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $whastapp['selector']; ?>nama_rak<?= $whastapp['selector']; ?></span></td>
                                  <td>Nama Rak Dari Buku Yang Dipinjam</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $whastapp['selector']; ?>pinjam<?= $whastapp['selector']; ?></span></td>
                                  <td>Hari Peminjaman</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $whastapp['selector']; ?>terlambat_siswa<?= $whastapp['selector']; ?></span></td>
                                  <td>Hari Keterlambatan Pengembalian</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $whastapp['selector']; ?>denda_siswa<?= $whastapp['selector']; ?></span></td>
                                  <td>Denda Keterlambatan (contoh : 10000)</td>
                                </tr>
                            </table>
                        </div>
                      </div>
                    </div>
                  <!-- <div class="form-group">
                    <label for="email">Email Sekolah</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat Sekolah</label>
                    <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
                  </div> -->
                  <!-- <div class="form-group">
                    <label for="nisn">NISN Siswa</label>
                    <input type="text" name="nisn" class="form-control" id="nisn" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Siswa</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="kelas">Pilih Kelas</label>
                      <select id="kelas" name="kelas" class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tahun">Pilih Tahun Ajaran</label>
                      <select id="tahun" name="tahun" class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                  <div class="form-group">
                    <label for="nomorwa">Nomor WhastApp</label>
                    <input type="text" name="nomorwa" class="form-control" id="nomorwa" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="email">Email Siswa</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat Siswa</label>
                    <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary my-1"><i class="fas fa-solid fa-pen"></i> Ubah Pesan WhastApp</button>
                  <a href="<?= base_url('pustakawan/whastapp'); ?>" class="btn btn-danger my-1"><i class="fas fa-solid fa-ban"></i> Batal</a>
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