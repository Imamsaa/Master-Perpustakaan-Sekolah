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
            <h1 class="m-0">Ubah Peengguna</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pengguna</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan/user'); ?>">Pengguna</a></li>
              <li class="breadcrumb-item">Ubah</li>
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
                    <h3>Ubah Pengguna</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('pustakawan/user/ubah/update'); ?>" method="POST" enctype="multipart/form-data" class="formconfirm">
                <div class="card-body">
                  <div class="row mb-2">
                    <div class="col-md-3 my-2 col-sm-12">
                      <img src="<?= base_url('admin/img/pustakawan/'.$user['foto_user']); ?>" alt="Foto Pengguna" class="img-thumbnail">
                    </div>
                    <div class="col-md-9 col-sm-12">
                      <div class="form-group">
                        <label for="foto_user">Unggah Foto Penguna</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input name="foto_user" type="file" class="custom-file-input" id="foto_user">
                            <label class="custom-file-label" for="foto_user">Pilih file gambar</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nama_user">Nama Pengguna</label>
                    <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
                    <input type="text" value="<?= (old('nama_user')) ? old('nama_user') : $user['nama_user']; ?>" name="nama_user" class="form-control" id="nama_user" placeholder="" required>
                  </div>
                  <div class="form-group">
                    <label for="username">Username Pengguna</label>
                    <input type="text" value="<?= (old('username')) ? old('username') : $user['username']; ?>" name="username" class="form-control" id="username" placeholder="" required>
                  </div>
                  <div class="form-group">
                    <label for="nomor_wa">Nomor WhastApp</label>
                    <input type="text" value="<?= (old('nomor_wa')) ? old('nomor_wa') : $user['nomor_wa']; ?>" name="nomor_wa" class="form-control" id="nomor_wa" placeholder="" required>
                  </div>
                  <div class="form-group">
                    <label for="email_user">Email Pengguna</label>
                    <input type="email" value="<?= (old('email_user')) ? old('email_user') : $user['email_user']; ?>" name="email_user" class="form-control" id="email_user" placeholder="" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password Pengguna</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="id_level">Level Pengguna</label>
                      <select id="id_level" name="id_level" class="form-control" required>
                        <option></option>
                        <?php foreach($level as $l) : ?>
                        <option value="<?= $l['id_level']; ?>" <?= ($l['id_level'] == $user['id_level']) ? 'selected' : ''; ?> ><?= $l['nama_level']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  <div class="form-group">
                    <label for="alamat_user">Alamat Pengguna</label>
                    <textarea name="alamat_user" class="form-control" id="alamat_user" rows="3"><?= (old('alamat_user')) ? old('alamat_user') : $user['alamat_user']; ?></textarea>
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" id="submitconfirm" class="btn btn-primary my-1"><i class="fas fa-solid fa-pen"></i> Ubah Pengguna</button>
                  <a href="<?= base_url('pustakawan/user'); ?>" class="btn btn-danger my-1"><i class="fas fa-solid fa-ban"></i> Batal</a>
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