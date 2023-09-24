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
            <h1 class="m-0">Tambah Buku</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan/buku'); ?>">Buku</a></li>
              <li class="breadcrumb-item">Tambah</li>
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
            <div class="card card-success">
              <div class="card-header">
                <div class="card-title">
                    <h3>Tambahkan Buku</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('pustakawan/buku/save'); ?>" method="POST" enctype="multipart/form-data">
              <?= csrf_field(); ?>
                <div class="card-body">
                  <div class="form-group">
                      <label for="judul_buku">Judul Buku</label>
                      <input type="text" value="<?= old('judul_buku'); ?>" name="judul_buku" class="form-control" id="judul_buku" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="isbn">Nomor ISBN Buku (Optional)</label>
                    <input type="text" value="<?= old('isbn'); ?>" name="isbn" class="form-control" id="isbn" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="stok">Stok Buku</label>
                    <input type="number" value="<?= old('stok'); ?>" name="stok" class="form-control" id="stok" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="tahun_buku">Tahun Buku (Optional)</label>
                    <input type="text" value="<?= old('tahun_buku'); ?>" name="tahun_buku" class="form-control" id="tahun_buku" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="kode_penerbit">Penerbit</label>
                      <select id="kode_penerbit" name="kode_penerbit" class="form-control">
                        <option></option>
                        <?php foreach($penerbit as $p) : ?>
                        <option value="<?= $p['kode_penerbit']; ?>" <?= (old('kode_penerbit') == $p['kode_penerbit']) ? 'selected' : ''; ?>><?= $p['nama_penerbit']; ?></option>
                        <?php endforeach; ?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="kode_rak">Rak Buku</label>
                    <select id="kode_rak" name="kode_rak" class="form-control">
                      <option></option>
                      <?php foreach($rak as $r) : ?>
                      <option value="<?= $r['kode_rak']; ?>" <?= (old('kode_rak') == $r['kode_rak']) ? 'selected' : ''; ?>><?= $r['nama_rak']; ?></option>
                      <?php endforeach; ?>
                      </select>
                  </div>
                    <div class="form-group">
                      <label for="kode_jenis">Jenis Buku</label>
                      <select id="kode_jenis" name="kode_jenis" class="form-control">
                        <option></option>
                        <?php foreach($jenis as $j) : ?>
                        <option value="<?= $j['kode_jenis']; ?>" <?= (old('kode_jenis') == $j['kode_jenis']) ? 'selected' : ''; ?>><?= $j['nama_jenis']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  <div class="form-group">
                    <label for="halaman">Jumlah halaman (Optional)</label>
                    <input type="text" value="<?= old('halaman'); ?>" name="halaman" class="form-control" id="halaman" placeholder="">
                  </div>
                  <!-- <div class="form-group">
                    <label for="email">Email Buku</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="">
                  </div> -->
                  <div class="form-group">
                    <label for="deskripsi_buku">Deskripsi Singkat Buku (Optional)</label>
                    <textarea name="deskripsi_buku" class="form-control" id="deskripsi_buku" rows="3"><?= old('deskripsi_buku'); ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="foto">Unggah Sampul Buku (Optional)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="sampul" type="file" class="custom-file-input" id="sampul">
                        <label class="custom-file-label" for="sampul">Pilih file gambar</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary my-1"><i class="fas fa-solid fa-plus"></i> Tambah Buku</button>
                  <a href="<?= base_url('pustakawan/buku'); ?>" class="btn btn-danger my-1"><i class="fas fa-solid fa-ban"></i> Batal</a>
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