<?= $this->extend("templates/default") ?>
<?= $this->section("content") ?>
<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col">
            <div class="row g-3 justify-content-center">

                <!-- BEST SELLER -->
                <div class="col" style="width: 20rem;">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <form action="<?= base_url('report-best-seller') ?>" method="get">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-trophy" style="font-size: 3rem;"></i>
                                </button>
                                <h5>Best Seller</h5>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- INVENTORY DAYS LEVEL -->
                <div class="col" style="width: 20rem;">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <form action="<?= base_url('inventory-days-report') ?>" method="get">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-cart4" style="font-size: 3rem;"></i>
                                </button>
                                <h5>Inventory Days Level</h5>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- COST TO SALES -->
                <div class="col" style="width: 20rem;">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <form action="#" method="get">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-cash-stack" style="font-size: 3rem;"></i>
                                </button>
                                <h5>Cost to Sales</h5>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- SALES PERFORMANCE -->
                <div class="col" style="width: 20rem;">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <form action="<?= base_url('report-sales-performance') ?>" method="get">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-bar-chart-line" style="font-size: 3rem;"></i>
                                </button>
                                <h5>Sales Performance</h5>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- CUSTOMER DEMOGRAPHICS -->
                <div class="col" style="width: 20rem;">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <form action="#" method="get">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-people" style="font-size: 3rem;"></i>
                                </button>
                                <h5>Customer Demographics</h5>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section("scripts") ?>
<?= $this->endSection() ?>