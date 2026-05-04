<!DOCTYPE html>
<html lang="en">
<?= view('header'); ?>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <!-- Start Start Script Section -->
    <?= $this->renderSection('startScript') ?>
    <!-- End of Start Script Section -->
    <?= view('navbar'); ?>
    <div class="container-fluid mt-3 px-5">
        <div class="row mb-3">
            <div class="col d-flex justify-content-center">
                <h1 class="text-capitalize"><?= $pageTitle ?></h1>
            </div>
        </div>
        <div class="row mb-3">
            <?=  $this->renderSection('content') ?>
        </div>
    </div>
<!-- Start End Script Section -->
        <?= $this->renderSection('endScript') ?>
<!-- End of End Script Section -->
</body>