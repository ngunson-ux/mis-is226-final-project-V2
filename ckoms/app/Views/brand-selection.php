<?= $this->extend("templates/default") ?>
<?= $this->section("content") ?>
<div class="container mt-5 text-center">

    <p class="mt-3">Please select a Cloud Kitchen Brand you'd like to Manage</p>

    <div class="row mt-5 justify-content-center">

        <?php foreach ($brands as $brand): ?>

            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">

                    <div class="card-body">
                        <h5 class="card-title"><?= esc($brand['brand_name']) ?></h5>

                        <a href="<?= base_url('cloud-kitchen-home') ?>?brandId=<?= $brand['brand_id'] ?>&brandName=<?= urlencode($brand['brand_name']) ?>"
                           class="btn btn-primary mt-3">
                            Manage
                        </a>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div>

</div>
<?= $this->endSection() ?> 