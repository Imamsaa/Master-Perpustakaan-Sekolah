<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-nav">
    <div class="container-fluid">
        <!-- <a class="navbar-brand" href="#">PERPUSTAKAAN</a> -->
        <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link font-weight-bold text-white" href="<?= base_url(); ?>">Pengunjung <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-weight-bold text-white" href="<?= base_url('peminjaman'); ?>">Peminjaman</a>
            </li>
            <li class="nav-item">
              <a class="nav-link font-weight-bold text-white" href="<?= base_url('login'); ?>">Login</a>
            </li>
          </ul>
    </div>
  </div>
</nav>