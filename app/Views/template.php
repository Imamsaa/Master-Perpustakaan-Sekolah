<?= $this->include('header'); ?>
<div class="container-fluid">
<?= $this->include('menu'); ?>
    <div class="row no-gutter">
        <!-- The image half -->
         <?= $this->renderSection('tampilan'); ?>
        <!-- The content half -->
        <!-- End -->
        <?= $this->renderSection('form'); ?>

    </div>
</div>
<?= $this->include('footer'); ?>