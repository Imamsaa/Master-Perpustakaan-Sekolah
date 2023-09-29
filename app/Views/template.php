<?= $this->include('header'); ?>
<?= $this->include('menu'); ?>
<div class="container-fluid bg-image">
    <div class="row no-gutter">
        <!-- The image half -->
         <?= $this->renderSection('tampilan'); ?>
        <!-- The content half -->
        <!-- End -->
        <?= $this->renderSection('form'); ?>

    </div>
</div>
<?= $this->include('footer'); ?>