<!DOCTYPE html>
<html lang="en">
<?= view('header'); ?>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <?= view('navbar'); ?>
    <div class="container-fluid mt-3 px-5">
        <div class="row mb-3">
            <div class="col d-flex justify-content-center">
                <h1 class="text-capitalize">Manage Rider Payment</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="button" class="btn btn-success mb-3"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#paymentDetails"
                    data-bs-payment-action="Add">
                    + Add Rider Payment
                </button>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>Payment ID</th>
                            <th>Delivery Partner ID</th>
                            <th>Payment Amount</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $payments = $result['data'] ?? []; ?>
                        <?php foreach ($payments as $payment): ?>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-info btn-sm"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#paymentDetails"
                                    data-bs-payment-action="View"
                                    data-bs-payment-id="<?= $payment['payment_id'] ?>"
                                    data-bs-payment-partner-id="<?= $payment['delivery_partner_id'] ?>"
                                    data-bs-payment-amount="<?= $payment['payment_amount'] ?>"
                                    data-bs-payment-method="<?= $payment['payment_method'] ?>"
                                    data-bs-payment-status="<?= $payment['payment_status'] ?>">View</button>
                                <button type="button" class="btn btn-warning btn-sm"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#paymentDetails"
                                    data-bs-payment-action="Edit"
                                    data-bs-payment-id="<?= $payment['payment_id'] ?>"
                                    data-bs-payment-partner-id="<?= $payment['delivery_partner_id'] ?>"
                                    data-bs-payment-amount="<?= $payment['payment_amount'] ?>"
                                    data-bs-payment-method="<?= $payment['payment_method'] ?>"
                                    data-bs-payment-status="<?= $payment['payment_status'] ?>">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#paymentDetails"
                                    data-bs-payment-action="Delete"
                                    data-bs-payment-id="<?= $payment['payment_id'] ?>"
                                    data-bs-payment-partner-id="<?= $payment['delivery_partner_id'] ?>"
                                    data-bs-payment-amount="<?= $payment['payment_amount'] ?>"
                                    data-bs-payment-method="<?= $payment['payment_method'] ?>"
                                    data-bs-payment-status="<?= $payment['payment_status'] ?>">Delete</button>
                            </td>
                            <td><?= $payment['payment_id'] ?></td>
                            <td><?= $payment['partner_name'] ?? $payment['delivery_partner_id'] ?></td>
                            <td><?= $payment['payment_amount'] ?></td>
                            <td><?= $payment['payment_method'] ?></td>
                            <td><?= $payment['payment_status'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6"><?= $result['pager']->links() ?></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="offcanvas offcanvas-end w-100" data-bs-backdrop="static" tabindex="-1" id="paymentDetails" aria-labelledby="paymentDetailsLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="paymentDetailsLabel">Rider Payment Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div id="formMessage" class="alert d-none"></div>
                        <form id="paymentForm" class="needs-validation" novalidate>
                            <input type="hidden" id="paymentId">
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
                                <label for="paymentAmount" class="form-label">Payment Amount</label>
                                <input type="number" step="0.01" class="form-control" id="paymentAmount" placeholder="0.00" required>
                                <div class="invalid-feedback">Please provide a payment amount.</div>
                            </div>
                            <div class="mb-3">
                                <label for="paymentMethod" class="form-label">Payment Method</label>
                                <select class="form-select" id="paymentMethod" required>
                                    <option value="">-- Select Method --</option>
                                    <option value="cash">Cash</option>
                                    <option value="gcash">GCash</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>
                                <div class="invalid-feedback">Please select a payment method.</div>
                            </div>
                            <div class="mb-3">
                                <label for="paymentStatus" class="form-label">Payment Status</label>
                                <select class="form-select" id="paymentStatus" required>
                                    <option value="">-- Select Status --</option>
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                <div class="invalid-feedback">Please select a payment status.</div>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const offcanvasEl = document.getElementById('paymentDetails');
        const form = document.getElementById('paymentForm');
        const formMessage = document.getElementById('formMessage');
        let currentAction = '';

        offcanvasEl.addEventListener('show.bs.offcanvas', function(event) {
            const btn = event.relatedTarget;
            currentAction = btn.getAttribute('data-bs-payment-action');
            formMessage.classList.add('d-none');
            form.classList.remove('was-validated');

            document.getElementById('paymentId').value = btn.getAttribute('data-bs-payment-id') ?? '';
            document.getElementById('deliveryPartnerId').value = btn.getAttribute('data-bs-payment-partner-id') ?? '';
            document.getElementById('paymentAmount').value = btn.getAttribute('data-bs-payment-amount') ?? '';
            document.getElementById('paymentMethod').value = btn.getAttribute('data-bs-payment-method') ?? '';
            document.getElementById('paymentStatus').value = btn.getAttribute('data-bs-payment-status') ?? '';

            const submitBtn = document.getElementById('submitBtn');
            const inputs = form.querySelectorAll('input, select');

            if (currentAction === 'View') {
                inputs.forEach(i => i.setAttribute('disabled', true));
                submitBtn.style.display = 'none';
                document.getElementById('paymentDetailsLabel').textContent = 'View Rider Payment';
            } else if (currentAction === 'Edit') {
                inputs.forEach(i => i.removeAttribute('disabled'));
                submitBtn.style.display = 'block';
                submitBtn.textContent = 'Save Changes';
                submitBtn.className = 'btn btn-primary';
                document.getElementById('paymentDetailsLabel').textContent = 'Edit Rider Payment';
            } else if (currentAction === 'Delete') {
                inputs.forEach(i => i.setAttribute('disabled', true));
                submitBtn.style.display = 'block';
                submitBtn.textContent = 'Confirm Delete';
                submitBtn.className = 'btn btn-danger';
                document.getElementById('paymentDetailsLabel').textContent = 'Delete Rider Payment';
            } else {
                form.reset();
                inputs.forEach(i => i.removeAttribute('disabled'));
                submitBtn.style.display = 'block';
                submitBtn.textContent = 'Add Payment';
                submitBtn.className = 'btn btn-success';
                document.getElementById('paymentDetailsLabel').textContent = 'Add Rider Payment';
            }
        });

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            if (currentAction !== 'Delete' && !form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            const id = document.getElementById('paymentId').value;
            const payload = {
                delivery_partner_id: document.getElementById('deliveryPartnerId').value,
                payment_amount: document.getElementById('paymentAmount').value,
                payment_method: document.getElementById('paymentMethod').value,
                payment_status: document.getElementById('paymentStatus').value,
                created_by: 'admin',
                updated_by: 'admin',
            };

            let url = '/api/rider-payment';
            let method = 'POST';

            if (currentAction === 'Edit') {
                url = '/api/rider-payment/' + id;
                method = 'PUT';
            } else if (currentAction === 'Delete') {
                url = '/api/rider-payment/' + id;
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
                    formMessage.textContent = currentAction === 'Delete' ? 'Payment deleted successfully.' : 'Payment saved successfully.';
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
