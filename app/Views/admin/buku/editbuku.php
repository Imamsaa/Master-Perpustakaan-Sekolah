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
            <h1 class="m-0">Ubah Buku</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan'); ?>">Pustakawan</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('pustakawan/buku'); ?>">Buku</a></li>
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
                    <h3>Ubah Buku</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="row mb-2">
                    <div class="col-md-3 my-2 col-sm-12">
                      <img src="<?= base_url('admin/img/cover_default.png'); ?>" alt="Foto Buku" class="img-thumbnail">
                    </div>
                    <div class="col-md-9 col-sm-12">
                      <div class="form-group">
                        <label for="sampul">Unggah Sampul Buku (Optional)</label>
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
                  </div>
                  <div class="form-group">
                      <label for="judul">Judul Buku</label>
                      <input type="text" name="judul" class="form-control" id="judul" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="isbn">Nomor ISBN Buku (Optional)</label>
                    <input type="text" name="isbn" class="form-control" id="isbn" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="stok">Stok Buku</label>
                    <input type="number" name="stok" class="form-control" id="stok" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="tahun">Tahun Buku (Optional)</label>
                    <input type="text" name="tahun" class="form-control" id="tahun" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="kode_penerbit">Penerbit</label>
                      <select id="kode_penerbit" name="kode_penerbit" class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="kode_rak">Rak Buku</label>
                      <select id="kode_rak" name="kode_rak" class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="kode_jenis">Jenis Buku</label>
                      <select id="kode_jenis" name="kode_jenis" class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                  <div class="form-group">
                    <label for="nomorwa">Jumlah halaman (Optional)</label>
                    <input type="text" name="nomorwa" class="form-control" id="nomorwa" placeholder="">
                  </div>
                  <!-- <div class="form-group">
                    <label for="email">Email Buku</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="">
                  </div> -->
                  <div class="form-group">
                    <label for="deskripsi">Deskripsi Singkat Buku (Optional)</label>
                    <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary my-1"><i class="fas fa-solid fa-pen"></i> Ubah Buku</button>
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