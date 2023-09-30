<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="<?= base_url('dist/js/bootstrap.min.js'); ?>" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('vendor/sweetalert2/dist/sweetalert2.all.js'); ?>"></script>

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

</body>
</html>