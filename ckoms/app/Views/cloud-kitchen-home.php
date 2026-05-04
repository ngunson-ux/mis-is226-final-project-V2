<?= $this->extend("templates/default") ?>
<?= $this->section("content") ?>
<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col">
            <div class="row g-3 justify-content-center">

                <!-- EDIT BRAND -->
                <div class="col" style="width: 20rem;">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <form action="/manage-brand" method="get">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-house-gear" style="font-size: 3rem;"></i>
                                </button>
                                <h5>Edit Brand</h5>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- EDIT MENU -->
                <div class="col" style="width: 20rem;">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <form action="<?= base_url('edit-menu') ?>" method="get">
                                <input type="hidden" name="brandId" value="<?= esc($brandId) ?>">
                                <input type="hidden" name="brandName" value="<?= esc($brandName) ?>">

                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-fork-knife" style="font-size: 3rem;"></i>
                                </button>
                                <h5>Manage Menu</h5>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- MANAGE CUSTOMERS -->
                <div class="col" style="width: 20rem;">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <form action="/customers" method="get">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-person" style="font-size: 3rem;"></i>
                                </button>
                                <h5>Manage Customers</h5>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- MANAGE INVENTORY -->
                <div class="col" style="width: 20rem;">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <form action="/manage-inventory" method="get">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-cart" style="font-size: 3rem;"></i>
                                </button>
                                <h5>Manage Inventory</h5>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- TRANSACTIONS -->
                <div class="col" style="width: 20rem;">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <form action="/transactions" method="get">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-receipt" style="font-size: 3rem;"></i>
                                </button>
                                <h5>Manage Transactions</h5>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- DELIVERY MANAGEMENT -->
                <div class="col" style="width: 20rem;">
                    <div class="card h-100">
                        <div class="card-body text-center">
                        <form action="/delivery-management" method="get">
                            <!-- TODO: Change button to submit -->
                            <button id="deliveryManagement" aria-label="Manage Deliveries" class="btn btn-primary" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-bicycle" viewBox="0 0 16 16">
                                <path d="M4 4.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1v.5h4.14l.386-1.158A.5.5 0 0 1 11 4h1a.5.5 0 0 1 0 1h-.64l-.311.935.807 1.29a3 3 0 1 1-.848.53l-.508-.812-2.076 3.322A.5.5 0 0 1 8 10.5H5.959a3 3 0 1 1-1.815-3.274L5 5.856V5h-.5a.5.5 0 0 1-.5-.5m1.5 2.443-.508.814c.5.444.85 1.054.967 1.743h1.139zM8 9.057 9.598 6.5H6.402zM4.937 9.5a2 2 0 0 0-.487-.877l-.548.877zM3.603 8.092A2 2 0 1 0 4.937 10.5H3a.5.5 0 0 1-.424-.765zm7.947.53a2 2 0 1 0 .848-.53l1.026 1.643a.5.5 0 1 1-.848.53z"/>
                                </svg>
                            </button>
                            <h5 class="card-title"><label for="deliveryManagement">Manage Deliveries</label></h5>
                        </form>
                        </div>
                    </div>
                </div>

                                <!-- REPORTS -->
                <div class="col" style="width: 20rem;">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <form action="/reports-home" method="get">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-table" style="font-size: 3rem;"></i>
                                </button>
                                 <h5>Reports Home</h5>
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