<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?= base_url('brand-selection') ?>">
        <span style="margin-left: 20px;">Welcome!</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <!-- SINGLE HOME -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('brand-selection') ?>">
                    <i class="bi bi-house"></i> Home
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('manage-brand') ?>">Brand</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('manage-menu') ?>">Menu</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('customers') ?>">Customers</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ingredients
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= base_url('manage-inventory') ?>">Manage Ingredients</a>
                    <a class="dropdown-item" href="<?= base_url('add-bom') ?>?menuItemId=<?= isset($menuItemId) ? $menuItemId : '' ?>">
                        Add Menu Item Ingredients
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="deliveryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Delivery
                </a>
                <div class="dropdown-menu" aria-labelledby="deliveryDropdown">
                    <a class="dropdown-item" href="/delivery-partners">Delivery Partners</a>
                    <a class="dropdown-item" href="/manage-delivery-expense">Delivery Expense</a>
                    <a class="dropdown-item" href="/manage-rider-payment">Rider Payment</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Reports
                </a>
                <div class="dropdown-menu" aria-labelledby="reportsDropdown">
                    <a class="dropdown-item" href="<?= base_url('report-best-seller') ?>">Best Seller</a>
                    <a class="dropdown-item" href="<?= base_url('inventory-days-report') ?>">Inventory Days Report</a>
                    <a class="dropdown-item" href="#">Cost to Sales</a>
                    <a class="dropdown-item" href="<?= base_url('report-sales-performance') ?>">Sales Performance</a>
                    <a class="dropdown-item" href="#">Customer Demographics</a>
                </div>
            </li>

            <!--
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
  -->
        </ul>
        <!--
        <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
  -->
    </div>
</nav>
<script>

</script>