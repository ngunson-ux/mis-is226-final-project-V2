<!DOCTYPE html>
<html lang="en">
<?= view('header'); ?>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <?= view('navbar'); ?>
    <div class="container-fluid mt-3 px-5">
        <div class="row mb-3">
            <div class="col d-flex justify-content-center">
                <h1 class="text-capitalize">Manage Delivery Expense</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <ul class="nav nav-tabs mb-3" id="expenseTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completedDeliveries" type="button" role="tab">
                            Completed Deliveries
                            <?php if (!empty($completedInvoices)): ?>
                                <span class="badge bg-danger"><?= count($completedInvoices) ?></span>
                            <?php endif; ?>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="expenses-tab" data-bs-toggle="tab" data-bs-target="#deliveryExpenses" type="button" role="tab">
                            Delivery Expenses
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="expenseTabContent">
                    <!-- Tab 1: Completed Deliveries -->
                    <div class="tab-pane fade show active" id="completedDeliveries" role="tabpanel">
                        <?php if (empty($completedInvoices)): ?>
                            <div class="alert alert-success">All completed deliveries have been processed.</div>
                        <?php else: ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Invoice ID</th>
                                        <th>Customer ID</th>
                                        <th>Total Amount</th>
                                        <th>Delivery Fee</th>
                                        <th>Delivery Address</th>
                                        <th>Date Completed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($completedInvoices as $invoice): ?>
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm btn-process"
                                                data-bs-toggle="offcanvas"
                                                data-bs-target="#expenseDetails"
                                                data-bs-expense-action="Add"
                                                data-bs-expense-invoice-id="<?= $invoice['sales_invoice_id'] ?>"
                                                data-bs-expense-fee="<?= $invoice['total_delivery_fee'] ?>">
                                                Process
                                            </button>
                                        </td>
                                        <td><?= $invoice['sales_invoice_id'] ?></td>
                                        <td><?= $invoice['customer_id'] ?></td>
                                        <td><?= number_format($invoice['total_amount'], 2) ?></td>
                                        <td><?= number_format($invoice['total_delivery_fee'], 2) ?></td>
                                        <td><?= $invoice['delivery_address'] ?></td>
                                        <td><?= $invoice['date_updated'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>

                    <!-- Tab 2: Delivery Expenses -->
                    <div class="tab-pane fade" id="deliveryExpenses" role="tabpanel">
                        <button type="button" class="btn btn-success mb-3"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#expenseDetails"
                            data-bs-expense-action="Add">
                            + Add Delivery Expense
                        </button>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Expense ID</th>
                                    <th>Delivery Partner</th>
                                    <th>Sales Invoice</th>
                                    <th>Delivery Fee</th>
                                    <th>Expense Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $expenses = $result['data'] ?? []; ?>
                                <?php foreach ($expenses as $expense): ?>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm"
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#expenseDetails"
                                            data-bs-expense-action="View"
                                            data-bs-expense-id="<?= $expense['expense_id'] ?>"
                                            data-bs-expense-partner-id="<?= $expense['delivery_partner_id'] ?>"
                                            data-bs-expense-invoice-id="<?= $expense['sales_invoice_id'] ?>"
                                            data-bs-expense-fee="<?= $expense['delivery_fee'] ?>"
                                            data-bs-expense-date="<?= $expense['expense_date'] ?>">View</button>
                                        <button type="button" class="btn btn-warning btn-sm"
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#expenseDetails"
                                            data-bs-expense-action="Edit"
                                            data-bs-expense-id="<?= $expense['expense_id'] ?>"
                                            data-bs-expense-partner-id="<?= $expense['delivery_partner_id'] ?>"
                                            data-bs-expense-invoice-id="<?= $expense['sales_invoice_id'] ?>"
                                            data-bs-expense-fee="<?= $expense['delivery_fee'] ?>"
                                            data-bs-expense-date="<?= $expense['expense_date'] ?>">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#expenseDetails"
                                            data-bs-expense-action="Delete"
                                            data-bs-expense-id="<?= $expense['expense_id'] ?>"
                                            data-bs-expense-partner-id="<?= $expense['delivery_partner_id'] ?>"
                                            data-bs-expense-invoice-id="<?= $expense['sales_invoice_id'] ?>"
                                            data-bs-expense-fee="<?= $expense['delivery_fee'] ?>"
                                            data-bs-expense-date="<?= $expense['expense_date'] ?>">Delete</button>
                                    </td>
                                    <td><?= $expense['expense_id'] ?></td>
                                    <td><?= $expense['partner_name'] ?? $expense['delivery_partner_id'] ?></td>
                                    <td><?= $expense['invoice_display'] ?? $expense['sales_invoice_id'] ?></td>
                                    <td><?= $expense['delivery_fee'] ?></td>
                                    <td><?= $expense['expense_date'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6"><?= $result['pager']->links() ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Offcanvas Form -->
                <div class="offcanvas offcanvas-end w-100" data-bs-backdrop="static" tabindex="-1" id="expenseDetails" aria-labelledby="expenseDetailsLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="expenseDetailsLabel">Delivery Expense Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div id="formMessage" class="alert d-none"></div>
                        <form id="expenseForm" class="needs-validation" novalidate>
                            <input type="hidden" id="expenseId">
                            <div class="mb-3">
                                <label for="deliveryPartnerId" class="form-label">Delivery Partner</label>
                                <select class="form-select" id="deliveryPartnerId" required>
                                    <option value="">-- Select Delivery Partner --</option>
                                    <?php foreach ($deliveryPartners as $partner): ?>
                                        <option value="<?= $partner['delivery_partner_id'] ?>">
                                            <?= $partner['first_name'] . ' ' . $partner['last_name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">Please select a delivery partner.</div>
                            </div>
                            <div class="mb-3">
                                <label for="salesInvoiceId" class="form-label">Sales Invoice</label>
                                <select class="form-select" id="salesInvoiceId" required>
                                    <option value="">-- Select Completed Invoice --</option>
                                    <?php foreach ($salesInvoices as $invoice): ?>
                                        <option value="<?= $invoice['sales_invoice_id'] ?>">
                                            Invoice #<?= $invoice['sales_invoice_id'] ?> - P<?= number_format($invoice['total_amount'], 2) ?> (<?= $invoice['delivery_address'] ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">Please select a sales invoice.</div>
                            </div>
                            <div class="mb-3">
                                <label for="deliveryFee" class="form-label">Delivery Fee</label>
                                <input type="number" step="0.01" class="form-control" id="deliveryFee" placeholder="0.00" required>
                                <div class="invalid-feedback">Please provide a delivery fee.</div>
                            </div>
                            <div class="mb-3">
                                <label for="expenseDate" class="form-label">Expense Date</label>
                                <input type="date" class="form-control" id="expenseDate" required>
                                <div class="invalid-feedback">Please provide an expense date.</div>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        const offcanvasEl = document.getElementById('expenseDetails');
        const form = document.getElementById('expenseForm');
        const formMessage = document.getElementById('formMessage');
        let currentAction = '';

        offcanvasEl.addEventListener('show.bs.offcanvas', function(event) {
            const btn = event.relatedTarget;
            currentAction = btn.getAttribute('data-bs-expense-action');
            formMessage.classList.add('d-none');
            form.classList.remove('was-validated');

            document.getElementById('expenseId').value = btn.getAttribute('data-bs-expense-id') ?? '';
            document.getElementById('deliveryPartnerId').value = btn.getAttribute('data-bs-expense-partner-id') ?? '';
            document.getElementById('salesInvoiceId').value = btn.getAttribute('data-bs-expense-invoice-id') ?? '';
            document.getElementById('deliveryFee').value = btn.getAttribute('data-bs-expense-fee') ?? '';
            document.getElementById('expenseDate').value = btn.getAttribute('data-bs-expense-date') ?? '';

            const submitBtn = document.getElementById('submitBtn');
            const inputs = form.querySelectorAll('input, select');

            if (currentAction === 'View') {
                inputs.forEach(i => i.setAttribute('disabled', true));
                submitBtn.style.display = 'none';
                document.getElementById('expenseDetailsLabel').textContent = 'View Delivery Expense';
            } else if (currentAction === 'Edit') {
                inputs.forEach(i => i.removeAttribute('disabled'));
                submitBtn.style.display = 'block';
                submitBtn.textContent = 'Save Changes';
                submitBtn.className = 'btn btn-primary';
                document.getElementById('expenseDetailsLabel').textContent = 'Edit Delivery Expense';
            } else if (currentAction === 'Delete') {
                inputs.forEach(i => i.setAttribute('disabled', true));
                submitBtn.style.display = 'block';
                submitBtn.textContent = 'Confirm Delete';
                submitBtn.className = 'btn btn-danger';
                document.getElementById('expenseDetailsLabel').textContent = 'Delete Delivery Expense';
            } else {
                if (!btn.classList.contains('btn-process')) {
                    form.reset();
                }
                inputs.forEach(i => i.removeAttribute('disabled'));
                submitBtn.style.display = 'block';
                submitBtn.textContent = 'Add Expense';
                submitBtn.className = 'btn btn-success';
                document.getElementById('expenseDetailsLabel').textContent = 'Add Delivery Expense';
            }
        });

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            if (currentAction !== 'Delete' && !form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            const id = document.getElementById('expenseId').value;
            const payload = {
                delivery_partner_id: document.getElementById('deliveryPartnerId').value,
                sales_invoice_id: document.getElementById('salesInvoiceId').value,
                delivery_fee: document.getElementById('deliveryFee').value,
                expense_date: document.getElementById('expenseDate').value,
                created_by: 'admin',
                updated_by: 'admin',
            };

            let url = '/api/delivery-expense';
            let method = 'POST';

            if (currentAction === 'Edit') {
                url = '/api/delivery-expense/' + id;
                method = 'PUT';
            } else if (currentAction === 'Delete') {
                url = '/api/delivery-expense/' + id;
                method = 'DELETE';
            }

            fetch(url, {
                method: method,
                headers: { 'Content-Type': 'application/json' },
                body: currentAction === 'Delete' ? null : JSON.stringify(payload),
            })
            .then(res => res.json())
            .then(data => {
                formMessage.classList.remove('d-none', 'alert-danger', 'alert-success');
                if (data.messages || data.status >= 400) {
                    formMessage.classList.add('alert-danger');
                    formMessage.textContent = JSON.stringify(data.messages ?? data);
                } else {
                    formMessage.classList.add('alert-success');
                    formMessage.textContent = currentAction === 'Delete' ? 'Expense deleted successfully.' : 'Expense saved successfully.';
                    setTimeout(() => location.reload(), 1000);
                }
            })
            .catch(() => {
                formMessage.classList.remove('d-none');
                formMessage.classList.add('alert-danger');
                formMessage.textContent = 'An error occurred. Please try again.';
            });
        });
    </script>
</body>
</html>
