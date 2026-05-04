<!DOCTYPE html>
<html lang="en">
<?=view('header'); ?>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <?=view('navbar'); ?>
    <div class="container-fluid mt-3 px-5">
        <div class="row mb-3" >
            <div class="col d-flex justify-content-center">
                <h1 class="text-capitalize">Manage Brand</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="button" class="btn btn-success mb-3"
                    ="offcanvas"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#brandDetails"
                    data-bs-brand-action="Add">
                    + Add Brand
                </button>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>Brand ID</th>
                            <th>Brand Name</th>
                            <th>Description</th>
                            <th>Contact Email</th>
                            <th>Contact Phone</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $brands = $result['data'] ?? []; ?>
                        <?php foreach ($brands as $brand):?>
                            <tr>
                            <td>
                                <button type="button" class="btn btn-info btn-sm"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#brandDetails"
                                    data-bs-brand-action="View"
                                    data-bs-brand-id="<?= $brand['brand_id'] ?>"
                                    data-bs-brand-name="<?= $brand['brand_name'] ?>"
                                    data-bs-brand-description="<?= $brand['brand_description'] ?>"
                                    data-bs-brand-logo-url="<?= $brand['brand_logo_url'] ?>"
                                    data-bs-brand-contact-email="<?= $brand['contact_email'] ?>"
                                    data-bs-brand-contact-phone="<?= $brand['contact_phone'] ?>"
                                    data-bs-brand-business-address="<?= $brand['business_address'] ?>"
                                    data-bs-brand-license-number="<?= $brand['business_license_number'] ?>"
                                    data-bs-brand-status="<?= $brand['brand_status'] ?>">View</button>
                                <button type="button" class="btn btn-warning btn-sm"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#brandDetails"
                                    data-bs-brand-action="Edit"
                                    data-bs-brand-id="<?= $brand['brand_id'] ?>"
                                    data-bs-brand-name="<?= $brand['brand_name'] ?>"
                                    data-bs-brand-description="<?= $brand['brand_description'] ?>"
                                    data-bs-brand-logo-url="<?= $brand['brand_logo_url'] ?>"
                                    data-bs-brand-contact-email="<?= $brand['contact_email'] ?>"
                                    data-bs-brand-contact-phone="<?= $brand['contact_phone'] ?>"
                                    data-bs-brand-business-address="<?= $brand['business_address'] ?>"
                                    data-bs-brand-license-number="<?= $brand['business_license_number'] ?>"
                                    data-bs-brand-status="<?= $brand['brand_status'] ?>">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#brandDetails"
                                    data-bs-brand-action="Delete"
                                    data-bs-brand-id="<?= $brand['brand_id'] ?>"
                                    data-bs-brand-name="<?= $brand['brand_name'] ?>"
                                    data-bs-brand-description="<?= $brand['brand_description'] ?>"
                                    data-bs-brand-logo-url="<?= $brand['brand_logo_url'] ?>"
                                    data-bs-brand-contact-email="<?= $brand['contact_email'] ?>"
                                    data-bs-brand-contact-phone="<?= $brand['contact_phone'] ?>"
                                    data-bs-brand-business-address="<?= $brand['business_address'] ?>"
                                    data-bs-brand-license-number="<?= $brand['business_license_number'] ?>"
                                    data-bs-brand-status="<?= $brand['brand_status'] ?>">Delete</button>
                            </td>
                            <td><a href="/cloud-kitchen-home?brandId=<?= $brand['brand_id'] ?>&brandName=<?= urlencode($brand['brand_name']) ?>"><?= $brand['brand_id'] ?></a></td>
                            <td><?= $brand['brand_name'] ?></td>
                            <td><?= $brand['brand_description'] ?></td>
                            <td><?= $brand['contact_email'] ?></td>
                            <td><?= $brand['contact_phone'] ?></td>
                            <td><?= $brand['brand_status'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7"><?= $result['pager']->links() ?></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="offcanvas offcanvas-end w-100" data-bs-backdrop="static" tabindex="-1" id="brandDetails" aria-labelledby="brandDetailsLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="brandDetailsLabel">Brand Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div id="formMessage" class="alert d-none"></div>
                        <form id="brandForm" class="needs-validation" novalidate>
                            <input type="hidden" id="brandId">
                            <div class="mb-3">
                                <label for="brandName" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" id="brandName" placeholder="Brand Name" required>
                                <div class="invalid-feedback">Please provide a brand name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="brandDescription" class="form-label">Description</label>
                                <input type="text" class="form-control" id="brandDescription" placeholder="Description" required>
                                <div class="invalid-feedback">Please provide a description.</div>
                            </div>
                            <div class="mb-3">
                                <label for="brandLogoUrl" class="form-label">Logo URL</label>
                                <input type="text" class="form-control" id="brandLogoUrl" placeholder="https://...">
                            </div>
                            <div class="mb-3">
                                <label for="contactEmail" class="form-label">Contact Email</label>
                                <input type="email" class="form-control" id="contactEmail" placeholder="email@example.com" required>
                                <div class="invalid-feedback">Please provide a valid email.</div>
                            </div>
                            <div class="mb-3">
                                <label for="contactPhone" class="form-label">Contact Phone</label>
                                <input type="text" class="form-control" id="contactPhone" placeholder="Contact Phone" required>
                                <div class="invalid-feedback">Please provide a contact phone.</div>
                            </div>
                            <div class="mb-3">
                                <label for="businessAddress" class="form-label">Business Address</label>
                                <input type="text" class="form-control" id="businessAddress" placeholder="Business Address" required>
                                <div class="invalid-feedback">Please provide a business address.</div>
                            </div>
                            <div class="mb-3">
                                <label for="licenseNumber" class="form-label">Business License Number</label>
                                <input type="text" class="form-control" id="licenseNumber" placeholder="License Number" required>
                                <div class="invalid-feedback">Please provide a license number.</div>
                            </div>
                            <div class="mb-3">
                                <label for="brandStatus" class="form-label">Status</label>
                                <select class="form-select" id="brandStatus" required>
                                    <option value="">-- Select Status --</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                <div class="invalid-feedback">Please select a status.</div>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <script>
        const offcanvasEl = document.getElementById('brandDetails');
        const form = document.getElementById('brandForm');
        const formMessage = document.getElementById('formMessage');
        let currentAction = '';

        offcanvasEl.addEventListener('show.bs.offcanvas', function(event) {
            const btn = event.relatedTarget;
            currentAction = btn.getAttribute('data-bs-brand-action');
            formMessage.classList.add('d-none');
            form.classList.remove('was-validated');

            const id = btn.getAttribute('data-bs-brand-id') ?? '';
            document.getElementById('brandId').value = id;
            document.getElementById('brandName').value = btn.getAttribute('data-bs-brand-name') ?? '';
            document.getElementById('brandDescription').value = btn.getAttribute('data-bs-brand-description') ?? '';
            document.getElementById('brandLogoUrl').value = btn.getAttribute('data-bs-brand-logo-url') ?? '';
            document.getElementById('contactEmail').value = btn.getAttribute('data-bs-brand-contact-email') ?? '';
            document.getElementById('contactPhone').value = btn.getAttribute('data-bs-brand-contact-phone') ?? '';
            document.getElementById('businessAddress').value = btn.getAttribute('data-bs-brand-business-address') ?? '';
            document.getElementById('licenseNumber').value = btn.getAttribute('data-bs-brand-license-number') ?? '';
            document.getElementById('brandStatus').value = btn.getAttribute('data-bs-brand-status') ?? '';

            const submitBtn = document.getElementById('submitBtn');
            const inputs = form.querySelectorAll('input, select');

            if (currentAction === 'View') {
                inputs.forEach(i => i.setAttribute('disabled', true));
                submitBtn.style.display = 'none';
                document.getElementById('brandDetailsLabel').textContent = 'View Brand: ' + document.getElementById('brandName').value;
            } else if (currentAction === 'Edit') {
                inputs.forEach(i => i.removeAttribute('disabled'));
                submitBtn.style.display = 'block';
                submitBtn.textContent = 'Save Changes';
                submitBtn.className = 'btn btn-primary';
                document.getElementById('brandDetailsLabel').textContent = 'Edit Brand: ' + document.getElementById('brandName').value;
            } else if (currentAction === 'Delete') {
                inputs.forEach(i => i.setAttribute('disabled', true));
                submitBtn.style.display = 'block';
                submitBtn.textContent = 'Confirm Delete';
                submitBtn.className = 'btn btn-danger';
                document.getElementById('brandDetailsLabel').textContent = 'Delete Brand: ' + document.getElementById('brandName').value;
            } else {
                form.reset();
                inputs.forEach(i => i.removeAttribute('disabled'));
                submitBtn.style.display = 'block';
                submitBtn.textContent = 'Add Brand';
                submitBtn.className = 'btn btn-success';
                document.getElementById('brandDetailsLabel').textContent = 'Add New Brand';
            }
        });

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            if (currentAction !== 'Delete' && !form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            const id = document.getElementById('brandId').value;
            const payload = {
                brand_name: document.getElementById('brandName').value,
                brand_description: document.getElementById('brandDescription').value,
                brand_logo_url: document.getElementById('brandLogoUrl').value,
                contact_email: document.getElementById('contactEmail').value,
                contact_phone: document.getElementById('contactPhone').value,
                business_address: document.getElementById('businessAddress').value,
                business_license_number: document.getElementById('licenseNumber').value,
                brand_status: document.getElementById('brandStatus').value,
                created_by: 'admin',
                updated_by: 'admin',
            };

            let url = '/api/brand';
            let method = 'POST';

            if (currentAction === 'Edit') {
                url = '/api/brand/' + id;
                method = 'PUT';
            } else if (currentAction === 'Delete') {
                url = '/api/brand/' + id;
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
                    formMessage.textContent = currentAction === 'Delete' ? 'Brand deleted successfully.' : 'Brand saved successfully.';
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