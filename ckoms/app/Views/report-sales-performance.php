<?= $this->extend("templates/default") ?>
<?= $this->section("content") ?>
<div class="row mb-3">
    <div class="row mb-3">
        <div class="col-auto">
            <form id="salesPerformanceForm" action="/report-sales-performance" method="get">
                <div class="input-group mb-3">
                    <label for="year" class="input-group-text">Year</label> 
                    <select name="year" id="year" class="form-select">
                        <option value="" selected>Select Year</option>
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                    </select>
                    <label for="month" class="input-group-text">Month</label> 
                    <select name="month" id="month" class="form-select">
                        <option value="" selected>Select Month</option>
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
                    <label for="day" class="input-group-text">Day</label> 
                    <select name="day" id="day" class="form-select">
                        <option value="" selected>Select Day</option>
                    </select>
                    <button aria-label="Search Ingredient Button" class="btn btn-primary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col d-flex">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Year</th>
                        <th scope="col">Month</th>
                        <th scope="col">Menu Item</th>
                        <th scope="col">Revenue</th>
                        <th scope="col">Total Orders</th>
                        <th scope="col">Quantity Sold</th>
                    </tr>
                </thead>
                <tbody id="salesTableBody">
                    <!-- Selected ingredients will be added here -->
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?= $this->endSection() ?>
<?= $this->section("endScript") ?>
<script>
    function addToTable(record) {
        const salesTableBody = document.getElementById('salesTableBody');
        salesTableBody.insertAdjacentHTML('beforeend', `
                 <tr>
                    <td>${record.year}</td>
                    <td>${record.month}</td>
                    <td>${record.menu_item}</td>
                    <td>${record.revenue}</td>
                    <td>${record.total_orders}</td>
                    <td>${record.qty_sold}</td>
                </tr>
            `);
    }

    function loadDaysInMonth(year, month) {
        const daySelect = document.getElementById("day");
        daySelect.innerHTML = "<option value=\"\" selected>Select Day</option>";
        if (year && month) {
            const daysInMonth = new Date(year, month, 0).getDate();
            for (let day = 1; day <= daysInMonth; day++) {
                const option = document.createElement('option');
                option.value = day;
                option.textContent = day;
                daySelect.appendChild(option);
            }
        }
    }

    document.getElementById("year").addEventListener("change", (event) => {
        const selectedYear = event.target.value;
        const monthSelect = document.getElementById("month");
        const selectedMonth = monthSelect.value;
        loadDaysInMonth(selectedYear, selectedMonth);
    });

    document.getElementById("month").addEventListener("change", (event) => {
        const selectedMonth = event.target.value;
        const yearSelect = document.getElementById("year");
        const selectedYear = yearSelect.value;
        loadDaysInMonth(selectedYear, selectedMonth);
    });

    document.addEventListener('DOMContentLoaded', () => {
        let year = "";
        let month = "";
        let day = "";
        if (window.location.search) {
            const urlParams = new URLSearchParams(window.location.search);
            year = urlParams.get("year") ?? "";
            month = urlParams.get("month") ?? "";
            day = urlParams.get("day") ?? "";

            let isValidYear = false;
            if (year) {
                document.getElementById("year").querySelectorAll("option").forEach((option) => {
                    if (option.value === year) {
                        option.selected = true;
                        isValidYear = true;
                    }
                });
            }
            let isValidMonth = false;
            if (month) {
                document.getElementById("month").querySelectorAll("option").forEach((option) => {
                    if (option.value === month) {
                        option.selected = true;
                        isValidMonth = true;
                    }
                });
            }
            if (isValidYear && isValidMonth) {
                loadDaysInMonth(year, month);
                if (day) {
                    document.getElementById("day").querySelectorAll("option").forEach((option) => {
                        if (option.value === day) {
                            option.selected = true;
                        }
                    });
                }
            }
        }

        fetch(`${window.location.origin}/api/report/brand/${<?= $brandId ?>}/sales-performance?year=${year}&month=${month}&day=${day}`, {
            method: 'GET',
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.json())
        .then(data => {
            data.forEach(record => {
                addToTable({
                        year: record.year,
                        month: record.month,
                        menu_item: record.menu_item,
                        revenue: record.revenue,
                        total_orders: record.total_orders,
                        qty_sold: record.qty_sold
                    });
                });
            }) // Handles the actual data
        .catch(error => {
            console.error(`Error: ${JSON.stringify(error)}`);
            return;
        });
    })


        
</script>
<?= $this->endSection() ?>