<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('admin/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('admin/dist/js/adminlte.min.js'); ?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('admin/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('admin/plugins/jszip/jszip.min.js'); ?>"></script>
<script src="<?= base_url('admin/plugins/pdfmake/pdfmake.min.js'); ?>"></script>
<script src="<?= base_url('admin/plugins/pdfmake/vfs_fonts.js'); ?>"></script>
<script src="<?= base_url('admin/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('admin/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?= base_url('admin/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url('vendor/sweetalert2/dist/sweetalert2.all.js'); ?>"></script>
</body>
</html>

<script>
  const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Signed in successfully'
})
</script>

<script>
var deleteLinks = document.querySelectorAll('.delete-link');

// Membuat event listener dan mengaitkannya dengan setiap elemen
deleteLinks.forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault();

        var url = this.getAttribute('href');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                window.location.href = url;
            }
        });
    });
});
</script>
<script>
    function submitForm(e) {
        e.preventDefault();
        const form = e.target.closest("form"); // Temukan elemen formulir terdekat

        Swal.fire({
            title: 'Apakah Anda yakin?',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim formulir yang terkait dengan tombol yang diklik
                form.submit();
            }
        });
    }

    // Tambahkan pemasang acara ke semua elemen dengan class "delete"
    const tombolHapus = document.querySelectorAll(".delete");
    tombolHapus.forEach((tombol) => {
        tombol.addEventListener("click", submitForm);
    });
</script>

<script>
    function submitForm(e) {
        e.preventDefault();
        const form = e.target.closest("form"); // Temukan elemen formulir terdekat

        Swal.fire({
            title: 'Apakah Anda yakin?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim formulir yang terkait dengan tombol yang diklik
                form.submit();
            }
        });
    }

    // Tambahkan pemasang acara ke semua elemen dengan class "submitconfirm"
    const tombolKirim = document.querySelectorAll(".submitconfirm");
    tombolKirim.forEach((tombol) => {
        tombol.addEventListener("click", submitForm);
    });
</script>


<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

<script>
  document.getElementById('message').addEventListener('keydown', function(e) {
      if (e.key == 'Tab') {
        e.preventDefault();
        var start = this.selectionStart;
        var end = this.selectionEnd;

        // set textarea value to: text before caret + tab + text after caret
        this.value = this.value.substring(0, start) +
          "\t" + this.value.substring(end);

        // put caret at right position again
        this.selectionStart =
          this.selectionEnd = start + 1;
      }
      });
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

  <?php if (session()->has('kotakok')) : ?>
  <?php $session = session()->get('kotakok'); ?>
  <script>
      Swal.fire({
      icon: '<?= $session['status'] ?>',
      title: '<?= $session['title']; ?>',
      text: '<?= $session['message']; ?>'
    });
  </script>
  <?php endif; ?>
  
  <?php if(session()->has('kotaktime')) : ?>
  <?php $session = session()->get('kotaktime'); ?>
  <script>
    Swal.fire({
      icon: '<?= $session['status']; ?>',
      title: '<?= $session['title']; ?>',
      text : '<?= $session['message']; ?>',
      showConfirmButton: false,
      timer: 3000
    });
  </script>
  <?php endif; ?>