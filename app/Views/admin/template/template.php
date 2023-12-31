<!DOCTYPE html>
<html lang="en">
<?= $this->include('admin/template/head'); ?>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?= $this->include('admin/template/topnav'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link elevation-4">
      <img src="<?= base_url('admin/img/'.$sekolah['logo']); ?>" alt="Sekolah Lumajang" class="brand-image elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold"><?= $perpus['nama_perpus']; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel text-center mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('admin/img/pustakawan/'.$aku['foto_user']); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="font-weight-bold text-center d-block"><?= $aku['nama_user']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <?= $this->include('admin/template/navbar'); ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    <?= $this->renderSection('content'); ?>

    <?= $this->include('admin/template/footer'); ?>
</body>
</html>
