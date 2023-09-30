<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-nav">
    <div class="container-fluid">
        <!-- <a class="navbar-brand" href="#">PERPUSTAKAAN</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link text-white font-weight-bold" href="<?= base_url(); ?>">Pengunjung <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white font-weight-bold" href="<?= base_url('peminjaman'); ?>">Peminjaman</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white font-weight-bold" href="<?= base_url('login'); ?>">Login</a>
            </li>
          </ul>
    </div>
  </div>
</nav>