<?= $this->extend('templates/default') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card mb-4">
        <div class="card-body">
            <h5>Add Delivery Partner</h5>
            <form onsubmit="return false;">
                <div class="row g-2">
                    <div class="col">
                        <input id="firstName" type="text" class="form-control" placeholder="First Name">
                    </div>
                    <div class="col">
                        <input id="lastName" type="text" class="form-control" placeholder="Last Name">
                    </div>
                    <div class="col">
                        <input id="contactNumber" type="text" class="form-control" placeholder="Contact Number">
                    </div>
                    <div class="col">
                        <input id="vehicleType" type="text" class="form-control" placeholder="Vehicle Type">
                    </div>
                    <div class="col">
                        <input id="plateNumber" type="text" class="form-control" placeholder="Plate Number">
                    </div>
                    <div class="col">
                        <input id="assignedArea" type="text" class="form-control" placeholder="Area">
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" type="button" onclick="addPartner()">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Delivery Partner List</h5>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Contact</th>
                        <th>Vehicle</th>
                        <th>Plate</th>
                        <th>Status</th>
                        <th>Area</th>
                        <th>Rating</th>
                        <th>Deliveries</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="deliveryTableBody">
                    <tr>
                        <td colspan="11" class="text-center">Loading...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Orders Assigned Modal -->
    <div class="modal fade" id="ordersModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Orders Assigned</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="ordersContent">Loading...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customers Served Modal -->
    <div class="modal fade" id="customersModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customers Served</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="customersContent">Loading...</div>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('endScript') ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    loadPartners();
});

function loadPartners() {
    fetch('/api/delivery-partner')
        .then(response => response.json())
        .then(data => {
            if (!data || data.length === 0) {
                document.getElementById("deliveryTableBody").innerHTML =
                    `<tr><td colspan="11" class="text-center">No data yet</td></tr>`;
                return;
            }

            let rows = "";
            data.forEach(item => {
                rows += `
                    <tr>
                        <td>${item.delivery_partner_id}</td>
                        <td>${item.first_name}</td>
                        <td>${item.last_name}</td>
                        <td>${item.contact_number}</td>
                        <td>${item.vehicle_type || 'N/A'}</td>
                        <td>${item.plate_number || 'N/A'}</td>
                        <td>${item.availability_status}</td>
                        <td>${item.assigned_area}</td>
                        <td>${item.rating || '0.00'}</td>
                        <td>${item.total_deliveries || 0}</td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="viewOrders(${item.delivery_partner_id})">Orders</button>
                            <button class="btn btn-sm btn-warning" onclick="viewCustomers(${item.delivery_partner_id})">Customers</button>
                            <button class="btn btn-sm btn-danger" onclick="deletePartner(${item.delivery_partner_id})">Delete</button>
                        </td>
                    </tr>
                `;
            });

            document.getElementById("deliveryTableBody").innerHTML = rows;
        })
        .catch(error => {
            console.error("API Error:", error);
            document.getElementById("deliveryTableBody").innerHTML =
                `<tr><td colspan="11" class="text-center text-danger">Error loading data</td></tr>`;
        });
}

function addPartner() {
    const firstName = document.getElementById("firstName").value.trim();
    const lastName = document.getElementById("lastName").value.trim();
    const contactNumber = document.getElementById("contactNumber").value.trim();
    const vehicleType = document.getElementById("vehicleType").value.trim();
    const plateNumber = document.getElementById("plateNumber").value.trim();
    const assignedArea = document.getElementById("assignedArea").value.trim();

    if (!firstName || !lastName || !contactNumber) {
        alert("First Name, Last Name, and Contact Number are required!");
        return;
    }

    const data = {
        first_name: firstName,
        last_name: lastName,
        contact_number: contactNumber,
        vehicle_type: vehicleType || null,
        plate_number: plateNumber || null,
        availability_status: "Available",
        assigned_area: assignedArea || "Unknown",
        rating: 0.00,
        total_deliveries: 0
    };

    fetch('/api/delivery-partner', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(result => {
        alert("Delivery partner added successfully!");
        document.getElementById("firstName").value = "";
        document.getElementById("lastName").value = "";
        document.getElementById("contactNumber").value = "";
        document.getElementById("vehicleType").value = "";
        document.getElementById("plateNumber").value = "";
        document.getElementById("assignedArea").value = "";
        loadPartners();
    })
    .catch(error => {
        console.error("Add Error:", error);
        alert("Error adding delivery partner: " + (error.message || JSON.stringify(error)));
    });
}

function viewOrders(partnerId) {
    fetch(`/api/delivery-partner/${partnerId}/orders`)
        .then(response => response.json())
        .then(data => {
            let content = `<p><strong>Partner:</strong> ${data.delivery_partner.first_name} ${data.delivery_partner.last_name}</p>`;
            
            if (!data.orders || data.orders.length === 0) {
                content += "<p>No orders assigned yet.</p>";
            } else {
                content += "<table class='table table-sm'><thead><tr><th>Order ID</th><th>Customer</th><th>Total Amount</th><th>Status</th></tr></thead><tbody>";
                data.orders.forEach(order => {
                    content += `<tr>
                        <td>${order.sales_invoice_id}</td>
                        <td>${order.first_name} ${order.last_name}</td>
                        <td>₱${order.total_amount}</td>
                        <td>${order.delivery_status || 'Pending'}</td>
                    </tr>`;
                });
                content += "</tbody></table>";
            }
            
            document.getElementById("ordersContent").innerHTML = content;
            new bootstrap.Modal(document.getElementById('ordersModal')).show();
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Error loading orders");
        });
}

function viewCustomers(partnerId) {
    fetch(`/api/delivery-partner/${partnerId}/customers`)
        .then(response => response.json())
        .then(data => {
            let content = `<p><strong>Partner:</strong> ${data.delivery_partner.first_name} ${data.delivery_partner.last_name}</p>`;
            
            if (!data.customers_served || data.customers_served.length === 0) {
                content += "<p>No customers served yet.</p>";
            } else {
                content += "<table class='table table-sm'><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>City</th></tr></thead><tbody>";
                data.customers_served.forEach(customer => {
                    content += `<tr>
                        <td>${customer.customer_id}</td>
                        <td>${customer.first_name} ${customer.last_name}</td>
                        <td>${customer.email_address}</td>
                        <td>${customer.city || 'N/A'}</td>
                    </tr>`;
                });
                content += "</tbody></table>";
            }
            
            document.getElementById("customersContent").innerHTML = content;
            new bootstrap.Modal(document.getElementById('customersModal')).show();
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Error loading customers");
        });
}

function deletePartner(partnerId) {
    if (!confirm("Are you sure you want to delete this delivery partner?")) {
        return;
    }

    fetch(`/api/delivery-partner/${partnerId}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(result => {
        if (result.message) {
            alert("Delivery partner deleted successfully!");
            loadPartners();
        } else {
            alert("Failed to delete delivery partner");
        }
    })
    .catch(error => {
        console.error("Delete Error:", error);
        alert("Error deleting delivery partner");
    });
}
</script>
<?= $this->endSection() ?>
