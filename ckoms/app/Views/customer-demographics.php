<?= $this->extend('templates/default') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card mb-4">
        <div class="card-body">
            <h5>Filter by Date Range</h5>
            <div class="row g-2">
                <div class="col">
                    <input id="startDate" type="date" class="form-control">
                </div>
                <div class="col">
                    <input id="endDate" type="date" class="form-control">
                </div>
                <div class="col">
                    <button class="btn btn-primary" onclick="filterDemographics()">Filter</button>
                    <button class="btn btn-secondary" onclick="loadAllDemographics()">Clear</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>Customer Demographics Report</h5>
            <table class="table table-bordered table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>City</th>
                        <th>Orders</th>
                        <th>Total Spending</th>
                        <th>Avg Order Value</th>
                        <th>Favorite Items</th>
                    </tr>
                </thead>
                <tbody id="demographicsTableBody">
                    <tr><td colspan="9" class="text-center">Loading...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('endScript') ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    loadAllDemographics();
});

function loadAllDemographics() {
    fetch('/api/customer-demographics-report')
        .then(response => response.json())
        .then(data => {
            renderTable(data);
        })
        .catch(error => {
            console.error("Error:", error);
            document.getElementById("demographicsTableBody").innerHTML =
                `<tr><td colspan="9" class="text-center text-danger">Error loading data: ${error}</td></tr>`;
        });
}

function filterDemographics() {
    const startDate = document.getElementById("startDate").value;
    const endDate = document.getElementById("endDate").value;

    if (!startDate || !endDate) {
        alert("Please select both start and end dates");
        return;
    }

    fetch(`/api/customer-demographics-report/by-date-range?start_date=${startDate}&end_date=${endDate}`)
        .then(response => response.json())
        .then(data => {
            renderTable(data);
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Error loading filtered data: " + error);
        });
}

function renderTable(data) {
    if (!data || data.length === 0) {
        document.getElementById("demographicsTableBody").innerHTML =
            `<tr><td colspan="9" class="text-center">No data found</td></tr>`;
        return;
    }

    let rows = "";
    data.forEach(item => {
        rows += `
            <tr>
                <td>${item.customer_id}</td>
                <td>${item.first_name} ${item.last_name}</td>
                <td>${item.gender || 'N/A'}</td>
                <td>${item.age || 'N/A'}</td>
                <td>${item.city || 'N/A'}</td>
                <td>${item.order_count || 0}</td>
                <td>₱${parseFloat(item.total_spending || 0).toFixed(2)}</td>
                <td>₱${parseFloat(item.avg_order_value || 0).toFixed(2)}</td>
                <td>${item.favorite_items || 'N/A'}</td>
            </tr>
        `;
    });

    document.getElementById("demographicsTableBody").innerHTML = rows;
}
</script>
<?= $this->endSection() ?>
