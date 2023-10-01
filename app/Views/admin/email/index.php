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
            <h1 class="m-0">Atur Pesan Email</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item">Pesan Email</li>
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
                <p class="card-text">Sebelum dapat mengirim email silahkan konfigurasi akses aplikasi pihak ketiga pada pengaturan email Anda melalui <a target="_blank" href="https://myaccount.google.com/connections/settings">https://myaccount.google.com/connections/settings</a> (beberapa akun Gmail tidak didukung)</p>
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
                    <h3>Atur Pesan Email</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('pustakawan/email/save'); ?>" method="post" class="formconfirm">
              <?= csrf_field(); ?>
                <div class="card-body">
                  <div class="form-group">
                      <label for="smtp">Server SMTP</label>
                      <input type="text" value="<?= (old('smtp')) ? old('smtp') : $email['smtp']; ?>" name="smtp" class="form-control" id="smtp" placeholder="" required>
                  </div>
                  <div class="form-group">
                      <label for="email">Email Pengirim</label>
                      <input type="email" value="<?= (old('email')) ? old('email') : $email['email']; ?>" name="email" class="form-control" id="email" placeholder="" required>
                  </div>
                  <div class="form-group">
                      <label for="password_email">Password Email Pengirim</label>
                      <input type="password" value="<?= (old('password_email')) ? old('password_email') : $email['password_email']; ?>" name="password_email" class="form-control" id="password_email" placeholder="" required>
                  </div>
                  <div class="form-group">
                      <label for="port">Port</label>
                      <input type="number" value="<?= (old('port')) ? old('port') : $email['port']; ?>" name="port" class="form-control" id="port" placeholder="" required>
                  </div>
                  <div class="form-group">
                      <label for="nama">Nama Pengirim</label>
                      <input type="text" value="<?= (old('nama')) ? old('nama') : $email['nama']; ?>" name="nama" class="form-control" id="nama" placeholder="" required>
                  </div>
                  <div class="form-group">
                      <label for="subject">Subject</label>
                      <input type="text" value="<?= (old('subject')) ? old('subject') : $email['subject']; ?>" name="subject" class="form-control" id="subject" placeholder="" required>
                  </div>
                  <div class="form-group">
                      <label for="selector">Selector Pesan</label>
                      <select id="selector" name="selector" class="form-control">
                        <?php foreach($selector as $s) : ?>
                        <option value="<?= $s['selector']; ?>" <?= ($s['selector'] == $email['selector']) ? 'selected' : ''; ?>><?= $s['selector']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  <div class="form-group">
                    <label class="col-lg-12" for="message">Isi Pesan</label>
                    <textarea name="message" class="form-control col-md-12 col-lg-12" id="message" rows="10"><?= (old('message')) ? old('message') : $email['message']; ?></textarea>
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
                                  <td><span class="text-danger font-weight-bold"><?= $email['selector']; ?>nis<?= $email['selector']; ?></span></td>
                                  <td>NIS Siswa</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $email['selector']; ?>nisn<?= $email['selector']; ?></span></td>
                                  <td>NISN Siswa</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $email['selector']; ?>nama_siswa<?= $email['selector']; ?></span></td>
                                  <td>Nama Siswa</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $email['selector']; ?>nama_kelas<?= $email['selector']; ?></span></td>
                                  <td>Kelas Siswa</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $email['selector']; ?>kode_buku<?= $email['selector']; ?></span></td>
                                  <td>Kode Buku Yang Dipinjam</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $email['selector']; ?>judul_buku<?= $email['selector']; ?></span></td>
                                  <td>Judul Buku Yang Dipinjam</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $email['selector']; ?>nama_rak<?= $email['selector']; ?></span></td>
                                  <td>Nama Rak Dari Buku Yang Dipinjam</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $email['selector']; ?>pinjam<?= $email['selector']; ?></span></td>
                                  <td>Hari Peminjaman</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $email['selector']; ?>terlambat_siswa<?= $email['selector']; ?></span></td>
                                  <td>Hari Keterlambatan Pengembalian</td>
                                </tr>
                                <tr>
                                  <td><span class="text-danger font-weight-bold"><?= $email['selector']; ?>denda_siswa<?= $email['selector']; ?></span></td>
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
                  <button type="submit" id="submitconfirm" class="btn btn-primary my-1"><i class="fas fa-solid fa-pen"></i> Ubah Pesan Email</button>
                  <a href="<?= base_url('pustakawan/email'); ?>" class="btn btn-danger my-1"><i class="fas fa-solid fa-ban"></i> Batal</a>
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