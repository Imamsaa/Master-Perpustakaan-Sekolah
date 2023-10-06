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
                <div class="row card-title">
                      <h3>Daftar Stok Buku</h3>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                <form action="<?= base_url('pustakawan/buku/stok'); ?>" method="post" class="d-inline">
                        <div class="form-group row">
                          <div class="col-md-9">
                            <!-- <label class="sr-only" for="inlineFormInput">Name</label> -->
                            <input type="number" name="stok" class="form-control mb-1" id="inlineFormInput" placeholder="Tambahkan Stok">
                          </div>
                            <button type="submit" class="btn mb-1 col-md-3 btn-success"><i class="fas fa-solid fa-plus"></i> Tambah Stok</button>
                        </div>
                      </form>
                      <table id="example1" class="table table-sm table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>NO</th>
                      <th>KODE</th>
                      <th>JUDUL</th>
                      <th>STATUS</th>
                      <th>RAK</th>
                      <th>JENIS</th>
                      <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; foreach($table as $tab) : ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $tab['kode_buku']; ?></td>
                      <td><?= $tab['judul_buku']; ?></td>
                      <td><?= $tab['statusbuku']; ?></td>
                      <td><?= $tab['nama_rak']; ?></td>
                      <td><?= $tab['nama_jenis']; ?></td>
                      <td>
                        <a href="<?= base_url('pustakawan/buku/deletebuku/'.$tab['slug'].'/'.$tab['kode_buku']); ?>" class="btn btn-sm delete-link btn-danger" ><i class="fas fa-solid fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php $no++; endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>NO</th>
                      <th>KODE</th>
                      <th>JUDUL</th>
                      <th>STATUS</th>
                      <th>RAK</th>
                      <th>JENIS</th>
                      <th>ACTION</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
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
              <form action="<?= base_url('pustakawan/buku/update'); ?>" method="post" enctype="multipart/form-data" class="formconfirm">
              <?= csrf_field(); ?>
              <div class="card-body">
                <div class="row mb-2">
                  <div class="col-md-3 my-2 col-sm-12">
                    <img src="<?= base_url('admin/img/buku/'.$buku['sampul']); ?>" alt="Foto Buku" class="img-thumbnail">
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
                  <input type="hidden" name="slug" value="<?= $buku['slug']; ?>">
                  <div class="form-group">
                    <label for="judul_buku">Judul Buku</label>
                    <input type="text" value="<?= (old('judul_buku')) ? old('judul_buku') : $buku['judul_buku']; ?>" name="judul_buku" class="form-control" id="judul_buku" placeholder="" required>
                    <input type="hidden" name="kode_buku" value="<?= $buku['kode_buku']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="isbn">Nomor ISBN Buku (Optional)</label>
                    <input type="text" value="<?= (old('isbn')) ? old('isbn') : $buku['isbn']; ?>" name="isbn" class="form-control" id="isbn" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="tahun_buku">Tahun Buku (Optional)</label>
                    <input type="text" value="<?= (old('tahun_buku')) ? old('tahun_buku') : $buku['tahun_buku']; ?>" name="tahun_buku" class="form-control" id="tahun_buku" placeholder="">
                  </div>
                  <div class="form-group">
                      <label for="kode_penerbit">Penerbit</label>
                      <select id="kode_penerbit" name="kode_penerbit" class="form-control" required>
                        <option></option>
                        <?php foreach($penerbit as $p) : ?>
                        <option value="<?= $p['kode_penerbit']; ?>" <?= ($p['kode_penerbit'] == $buku['kode_penerbit']) ? 'selected' : ''; ?>><?= $p['nama_penerbit']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="kode_rak">Rak Buku</label>
                      <select id="kode_rak" name="kode_rak" class="form-control" required>
                        <option></option>
                        <?php foreach($rak as $r) : ?>
                        <option value="<?= $r['kode_rak']; ?>" <?= ($r['kode_rak'] == $buku['kode_rak']) ? 'selected' : ''; ?>><?= $r['nama_rak']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="kode_jenis">Jenis Buku</label>
                      <select id="kode_jenis" name="kode_jenis" class="form-control" required>
                        <option></option>
                        <?php foreach($jenis as $j) : ?>
                        <option value="<?= $j['kode_jenis']; ?>" <?= ($j['kode_jenis'] == $buku['kode_jenis']) ? 'selected' : ''; ?>><?= $j['nama_jenis']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  <div class="form-group">
                    <label for="halaman">Jumlah halaman (Optional)</label>
                    <input type="text" value="<?= (old('halaman')) ? old('halaman') : $buku['halaman']; ?>" name="halaman" class="form-control" id="halaman" placeholder="">
                  </div>
                  <!-- <div class="form-group">
                    <label for="email">Email Buku</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="">
                  </div> -->
                  <div class="form-group">
                    <label for="deskripsi_buku">Deskripsi Singkat Buku (Optional)</label>
                    <textarea name="deskripsi_buku" class="form-control" id="deskripsi_buku" rows="3"><?= (old('deskripsi_buku')) ? old('deskripsi_buku') : $buku['deskripsi_buku']; ?></textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" id="submitconfirm" class="btn btn-primary my-1"><i class="fas fa-solid fa-pen"></i> Ubah Buku</button>
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