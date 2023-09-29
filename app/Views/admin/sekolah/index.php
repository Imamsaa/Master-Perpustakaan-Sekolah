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
            <h1 class="m-0">Profil Sekolah</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item">Sekolah</li>
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
                    <h3>Ubah Profil Sekolah</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('pustakawan/sekolah/update'); ?>" method="POST" enctype="multipart/form-data">
              <?= csrf_field(); ?>
                <div class="card-body">
                  <div class="row mb-2">
                    <div class="col-md-3 my-2 col-sm-12">
                      <img src="<?= base_url('admin/img/'.$sekolah['logo']); ?>" alt="Logo Sekolah" class="img-thumbnail">
                    </div>
                    <div class="col-md-9 col-sm-12">
                      <div class="form-group">
                        <label for="logo">Unggah Logo Sekolah</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input name="logo" type="file" class="custom-file-input" id="logo">
                            <label class="custom-file-label" for="foto">Pilih file gambar</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="nama_sekolah">Nama Sekolah</label>
                      <input type="text" value="<?= (old('nama_sekolah')) ? old('nama_sekolah') : $sekolah['nama_sekolah']; ?>" name="nama_sekolah" class="form-control" id="nama_sekolah" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="slogan_sekolah">Slogan Sekolah</label>
                      <input type="text" value="<?= (old('slogan_sekolah')) ? old('slogan_sekolah') : $sekolah['slogan_sekolah']; ?>" name="slogan_sekolah" class="form-control" id="slogan_sekolah" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="email_sekolah">Email Sekolah</label>
                    <input type="email" value="<?= (old('email_sekolah')) ? old('email_sekolah') : $sekolah['email_sekolah']; ?>" name="email_sekolah" class="form-control" id="email_sekolah" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="alamat_sekolah">Alamat Sekolah</label>
                    <textarea name="alamat_sekolah" class="form-control" id="alamat_sekolah" rows="3"><?= (old('alamat_sekolah')) ? old('alamat_sekolah') : $sekolah['alamat_sekolah']; ?></textarea>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-3 my-2 col-sm-12">
                      <img src="<?= base_url('img/'.$sekolah['background']); ?>" alt="Logo Sekolah" class="img-thumbnail">
                    </div>
                    <div class="col-md-9 col-sm-12">
                  <div class="form-group">
                    <label for="background">Unggah Background</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="background" type="file" class="custom-file-input" id="background">
                        <label class="custom-file-label" for="foto">Pilih file gambar</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  </div>
                  </div>
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
                  <button type="submit" class="btn btn-primary my-1"><i class="fas fa-solid fa-pen"></i> Ubah Profil Sekolah</button>
                  <a href="<?= base_url('pustakawan/sekolah'); ?>" class="btn btn-danger my-1"><i class="fas fa-solid fa-ban"></i> Batal</a>
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