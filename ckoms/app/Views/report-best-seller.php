<!DOCTYPE html>
<html lang="en">
<?= view('header'); ?>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <?= view('navbar'); ?>
    <div class="container-fluid mt-3 px-5">
        <div class="row mb-3">
            <div class="col d-flex justify-content-center">
                <h1 class="text-capitalize">Best Seller Report</h1>
            </div>
        </div>

        <!-- Filters -->
        <div class="row mb-3">
            <div class="col-auto">
                <label for="filterYear" class="form-label">Year</label>
                <select class="form-select" id="filterYear">
                    <option value="">All</option>
                    <option value="2026" selected>2026</option>
                    <option value="2025">2025</option>
                </select>
            </div>
            <div class="col-auto">
                <label for="filterMonth" class="form-label">Month</label>
                <select class="form-select" id="filterMonth">
                    <option value="">All</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div class="col-auto">
                <label for="filterDay" class="form-label">Day</label>
                <input type="number" class="form-control" id="filterDay" min="1" max="31" placeholder="All">
            </div>
            <div class="col-auto d-flex align-items-end">
                <button class="btn btn-primary" id="btnGenerate">Generate Report</button>
            </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs mb-3" id="reportTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="popular-tab" data-bs-toggle="tab" data-bs-target="#popularItems" type="button" role="tab">
                    Most Popular Items
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="revenue-tab" data-bs-toggle="tab" data-bs-target="#revenueRanking" type="button" role="tab">
                    Revenue Ranking
                </button>
            </li>
        </ul>

        <div class="tab-content" id="reportTabContent">
            <!-- Tab 1: Most Popular -->
            <div class="tab-pane fade show active" id="popularItems" role="tabpanel">
                <div id="popularLoading" class="text-center d-none">
                    <div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>
                </div>
                <div id="popularEmpty" class="alert alert-info d-none">No data found for the selected filters.</div>
                <table class="table table-striped d-none" id="popularTable">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Menu Item</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Total Qty Sold</th>
                            <th>Order Count</th>
                        </tr>
                    </thead>
                    <tbody id="popularBody"></tbody>
                </table>
            </div>

            <!-- Tab 2: Revenue Ranking -->
            <div class="tab-pane fade" id="revenueRanking" role="tabpanel">
                <div id="revenueLoading" class="text-center d-none">
                    <div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>
                </div>
                <div id="revenueEmpty" class="alert alert-info d-none">No data found for the selected filters.</div>
                <table class="table table-striped d-none" id="revenueTable">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Menu Item</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Total Revenue</th>
                            <th>Total Qty Sold</th>
                            <th>Order Count</th>
                        </tr>
                    </thead>
                    <tbody id="revenueBody"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function buildQuery() {
            const year = document.getElementById('filterYear').value;
            const month = document.getElementById('filterMonth').value;
            const day = document.getElementById('filterDay').value;
            let params = [];
            if (year) params.push('year=' + year);
            if (month) params.push('month=' + month);
            if (day) params.push('day=' + day);
            return params.length > 0 ? '?' + params.join('&') : '';
        }

        function formatNumber(num) {
            return parseFloat(num).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        function loadPopular() {
            const loading = document.getElementById('popularLoading');
            const empty = document.getElementById('popularEmpty');
            const table = document.getElementById('popularTable');
            const body = document.getElementById('popularBody');

            loading.classList.remove('d-none');
            empty.classList.add('d-none');
            table.classList.add('d-none');
            body.innerHTML = '';

            fetch('/api/report/best-seller/popular' + buildQuery())
                .then(res => res.json())
                .then(data => {
                    loading.classList.add('d-none');
                    if (data.length === 0) {
                        empty.classList.remove('d-none');
                        return;
                    }
                    table.classList.remove('d-none');
                    data.forEach((item, index) => {
                        body.innerHTML += `<tr>
                            <td>${index + 1}</td>
                            <td>${item.item_name}</td>
                            <td>${item.brand_name}</td>
                            <td>${item.menu_category}</td>
                            <td>${formatNumber(item.price)}</td>
                            <td>${item.total_quantity_sold}</td>
                            <td>${item.order_count}</td>
                        </tr>`;
                    });
                });
        }

        function loadRevenue() {
            const loading = document.getElementById('revenueLoading');
            const empty = document.getElementById('revenueEmpty');
            const table = document.getElementById('revenueTable');
            const body = document.getElementById('revenueBody');

            loading.classList.remove('d-none');
            empty.classList.add('d-none');
            table.classList.add('d-none');
            body.innerHTML = '';

            fetch('/api/report/best-seller/revenue' + buildQuery())
                .then(res => res.json())
                .then(data => {
                    loading.classList.add('d-none');
                    if (data.length === 0) {
                        empty.classList.remove('d-none');
                        return;
                    }
                    table.classList.remove('d-none');
                    data.forEach((item, index) => {
                        body.innerHTML += `<tr>
                            <td>${index + 1}</td>
                            <td>${item.item_name}</td>
                            <td>${item.brand_name}</td>
                            <td>${item.menu_category}</td>
                            <td>${formatNumber(item.price)}</td>
                            <td>${formatNumber(item.total_revenue)}</td>
                            <td>${item.total_quantity_sold}</td>
                            <td>${item.order_count}</td>
                        </tr>`;
                    });
                });
        }

        document.getElementById('btnGenerate').addEventListener('click', function() {
            loadPopular();
            loadRevenue();
        });

        // Load on page open
        loadPopular();
        loadRevenue();
    </script>
</body>
</html>
