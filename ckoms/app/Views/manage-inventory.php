<!DOCTYPE html>
<html lang="en">
<?= view('header'); ?>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <?= view('navbar'); ?>
    <div class="container-fluid mt-3 px-5">
        <div class="row mb-3">
            <div class="col d-flex justify-content-center">
                <h1 class="text-capitalize">Manage Inventory</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="button" class="btn btn-success mb-3"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#ingredientDetails"
                    data-bs-brand-id="<?= $brandId ?>"
                    data-bs-ingredient-action="Add">+ Add Ingredient</button>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Actions</th>
                            <th scope="col">Ingredient ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Description</th>
                            <th scope="col">Quantity Purchased</th>
                            <th scope="col">Quantity Remaining</th>
                            <th scope="col">Unit of Measure</th>
                            <th scope="col">Category</th>
                            <th scope="col">Allergen Flag</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ingredients = $result['data'] ?? []; // Ensure $data is an array even if 'data' key is missing
                        foreach ($ingredients as $ingredient) { ?>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-info" aria-label="View Ingredient"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#ingredientDetails"
                                        aria-controls="ingredientDetails"
                                        data-bs-ingredient-action="View"
                                        data-bs-ingredient-id="<?= $ingredient['ingredient_id'] ?>"
                                        data-bs-brand-id="<?= $ingredient['brand_id'] ?>"
                                        data-bs-ingredient-name="<?= $ingredient['name'] ?>"
                                        data-bs-ingredient-brand="<?= $ingredient['brand'] ?>"
                                        data-bs-ingredient-description="<?= $ingredient['description'] ?>"
                                        data-bs-ingredient-qty-purchased="<?= $ingredient['qty_purchased'] ?>"
                                        data-bs-ingredient-qty-remaining="<?= $ingredient['qty_remaining'] ?>"
                                        data-bs-ingredient-unit-of-measure="<?= $ingredient['unit_of_measure'] ?>"
                                        data-bs-ingredient-category="<?= $ingredient['category'] ?>"
                                        data-bs-ingredient-allergen-flag="<?= $ingredient['allergen_flag'] ?>">View</button>
                                    <button type="button" class="btn btn-warning" aria-label="Edit Ingredient"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#ingredientDetails"
                                        aria-controls="ingredientDetails"
                                        data-bs-ingredient-action="Edit"
                                        data-bs-ingredient-id="<?= $ingredient['ingredient_id'] ?>"
                                        data-bs-brand-id="<?= $ingredient['brand_id'] ?>"
                                        data-bs-ingredient-name="<?= $ingredient['name'] ?>"
                                        data-bs-ingredient-brand="<?= $ingredient['brand'] ?>"
                                        data-bs-ingredient-description="<?= $ingredient['description'] ?>"
                                        data-bs-ingredient-qty-purchased="<?= $ingredient['qty_purchased'] ?>"
                                        data-bs-ingredient-qty-remaining="<?= $ingredient['qty_remaining'] ?>"
                                        data-bs-ingredient-unit-of-measure="<?= $ingredient['unit_of_measure'] ?>"
                                        data-bs-ingredient-category="<?= $ingredient['category'] ?>"
                                        data-bs-ingredient-allergen-flag="<?= $ingredient['allergen_flag'] ?>">Edit</button>
                                    <button type="button" class="btn btn-danger" aria-label="Delete Ingredient"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#ingredientDetails"
                                        aria-controls="ingredientDetails"
                                        data-bs-ingredient-action="Delete"
                                        data-bs-ingredient-id="<?= $ingredient['ingredient_id'] ?>"
                                        data-bs-brand-id="<?= $ingredient['brand_id'] ?>"
                                        data-bs-ingredient-name="<?= $ingredient['name'] ?>"
                                        data-bs-ingredient-brand="<?= $ingredient['brand'] ?>"
                                        data-bs-ingredient-description="<?= $ingredient['description'] ?>"
                                        data-bs-ingredient-qty-purchased="<?= $ingredient['qty_purchased'] ?>"
                                        data-bs-ingredient-qty-remaining="<?= $ingredient['qty_remaining'] ?>"
                                        data-bs-ingredient-unit-of-measure="<?= $ingredient['unit_of_measure'] ?>"
                                        data-bs-ingredient-category="<?= $ingredient['category'] ?>"
                                        data-bs-ingredient-allergen-flag="<?= $ingredient['allergen_flag'] ?>">Delete</button>
                                </td>
                                <td>
                                    <p><?= $ingredient['ingredient_id'] ?></p>
                                </td>
                                <td>
                                    <p><?= $ingredient['name'] ?></p>
                                </td>
                                <td>
                                    <p><?= $ingredient['brand'] ?></p>
                                </td>
                                <td>
                                    <p><?= $ingredient['description'] ?></p>
                                </td>
                                <td>
                                    <p><?= $ingredient['qty_purchased'] ?></p>
                                </td>
                                <td>
                                    <p><?= $ingredient['qty_remaining'] ?></p>
                                </td>
                                <td>
                                    <p><?= $ingredient['unit_of_measure'] ?></p>
                                </td>
                                <td>
                                    <p><?= $ingredient['category'] ?></p>
                                </td>
                                <td>
                                    <p><?= $ingredient['allergen_flag'] ? 'Yes' : 'No' ?></p>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">
                                <?= $result['pager']->links() ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <div class="offcanvas offcanvas-end w-100" data-bs-backdrop="static" tabindex="-1" id="ingredientDetails" aria-labelledby="ingredientDetailsLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="ingredientDetailsLabel">Ingredient Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div id="formMessage" class="alert d-none"></div>
                        <form id="ingredientDetailsForm" class="needs-validation" novalidate>
                            <input type="hidden" id="ingredientId">
                            <input type="hidden" id="brandId">
                            <div class="mb-3">
                                <label for="ingredientName" class="form-label required">Ingredient Name</label>
                                <div class="has-validation">
                                    <input type="text" class="form-control" id="ingredientName" name="ingredientName" placeholder="Ingredient Name" required>
                                    <div class="invalid-feedback">
                                        Please choose an ingredient name.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ingredientBrand" class="form-label required">Brand</label>
                                <div class="has-validation">
                                    <input type="text" class="form-control" id="ingredientBrand" name="ingredientBrand" placeholder="Brand Name" required>
                                    <div class="invalid-feedback">
                                        Please choose a brand name.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ingredientDescription" class="form-label required">Description</label>
                                <div class="has-validation">
                                    <input type="text" class="form-control" id="ingredientDescription" name="ingredientDescription" placeholder="Description" required>
                                    <div class="invalid-feedback">
                                        Please provide a description.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ingredientQtyPurchased" class="form-label">Quantity Purchased</label>
                                <div class="has-validation">
                                    <input type="number" min="0" step="any" class="form-control" id="ingredientQtyPurchased" name="ingredientQtyPurchased" placeholder="0.00">
                                    <div class="invalid-feedback">
                                        Please provide a valid purchased quantity.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ingredientQtyRemaining" class="form-label">Quantity Remaining</label>
                                <div class="has-validation">
                                    <input type="number" min="0" step="any" class="form-control" id="ingredientQtyRemaining" name="ingredientQtyRemaining" placeholder="0.00">
                                    <div class="invalid-feedback">
                                        Please provide a valid remaining quantity.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ingredientUnitOfMeasure" class="form-label required">Unit of Measure</label>
                                <div class="has-validation">
                                    <input type="text" class="form-control" id="ingredientUnitOfMeasure" name="ingredientUnitOfMeasure" placeholder="Unit of Measure" required>
                                    <div class="invalid-feedback">
                                        Please provide the unit of measure.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ingredientCategory" class="form-label required">Category</label>
                                <div class="has-validation">
                                    <input type="text" class="form-control" id="ingredientCategory" name="ingredientCategory" placeholder="Category">
                                    <div class="invalid-feedback">
                                        Please provide a category.
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="ingredientAllergenFlag" name="ingredientAllergenFlag" value="1">
                                <label class="form-check-label" for="ingredientAllergenFlag">Contains Allergen</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const offcanvasEl = document.getElementById('ingredientDetails');
        // listener for form submission to handle create/update/delete actions
        const form = document.getElementById('ingredientDetailsForm');
        const formMessage = document.getElementById('formMessage');

        let currentAction = '';

        offcanvasEl.addEventListener('show.bs.offcanvas', function(event) {

            // Button that triggered the offcanvas
            const btn = event.relatedTarget;
            currentAction = btn.getAttribute('data-bs-ingredient-action');
            formMessage.classList.add('d-none');
            form.classList.remove('was-validated');

            // Extract info from data-bs-* attributes
            const ingredientId = btn.getAttribute('data-bs-ingredient-id');
            const brandId = btn.getAttribute('data-bs-brand-id');
            const ingredientName = btn.getAttribute('data-bs-ingredient-name');

            // Update the offcanvas content
            const offcanvasTitle = offcanvasEl.querySelector('.offcanvas-title')
            const saveButton = offcanvasEl.querySelector('button[type="submit"]');
            
            offcanvasTitle.textContent = currentAction + " Ingredient: " + ingredientName + " (ID: " + ingredientId + ")";
            document.getElementById('ingredientId').value = ingredientId;
            document.getElementById('ingredientName').value = ingredientName;
            document.getElementById('brandId').value = btn.getAttribute('data-bs-brand-id');
            document.getElementById('ingredientBrand').value = btn.getAttribute('data-bs-ingredient-brand');
            document.getElementById('ingredientDescription').value = btn.getAttribute('data-bs-ingredient-description');
            document.getElementById('ingredientQtyPurchased').value = btn.getAttribute('data-bs-ingredient-qty-purchased');
            document.getElementById('ingredientQtyRemaining').value = btn.getAttribute('data-bs-ingredient-qty-remaining');
            document.getElementById('ingredientUnitOfMeasure').value = btn.getAttribute('data-bs-ingredient-unit-of-measure');
            document.getElementById('ingredientCategory').value = btn.getAttribute('data-bs-ingredient-category');
            document.getElementById('ingredientAllergenFlag').checked = btn.getAttribute('data-bs-ingredient-allergen-flag') === '1';

            if (currentAction == 'Edit') {
                // Enable form fields for edit mode
                form.querySelectorAll('input').forEach(
                    function(input) {
                        input.removeAttribute('readonly');
                        if (input.type === 'checkbox') {
                            input.style.removeProperty('pointer-events');
                        }
                    }
                );
                saveButton.style.display = 'block';
                saveButton.removeAttribute('disabled');
                saveButton.textContent = 'Save Changes';
                saveButton.classList.remove('btn-danger');
                saveButton.classList.add('btn-primary');
            } else if (currentAction == 'Add') {
                form.reset();
                // Enable form fields for edit mode
                form.querySelectorAll('input').forEach(
                    function(input) {
                        input.removeAttribute('readonly');
                        if (input.type === 'checkbox') {
                            input.style.removeProperty('pointer-events');
                        }
                    }
                );
                saveButton.style.display = 'block';
                saveButton.textContent = 'Add Ingredient';
                saveButton.className = 'btn btn-success';
                offcanvasEl.querySelector('.offcanvas-title').textContent = 'Add New Ingredient';
            } else {
                // Disable form fields for view mode
                form.querySelectorAll('input').forEach(input => {
                        input.setAttribute('readonly', 'readonly');
                        if (input.type === 'checkbox') {
                            input.style.setProperty('pointer-events', 'none');
                        }
                    }
                );

                if (currentAction === 'View') {
                    saveButton.style.display = 'none';
                    saveButton.setAttribute('disabled', 'disabled');
                } else {
                    // Change save button to delete button
                    saveButton.style.display = 'block';
                    saveButton.removeAttribute('disabled');
                    saveButton.textContent = 'Confirm Delete';
                    saveButton.classList.remove('btn-primary');
                    saveButton.classList.add('btn-danger');
                }
            }

        });

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            if (currentAction !== 'Delete' && !form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            const id = document.getElementById('ingredientId').value;
            const payload = {
                name: document.getElementById('ingredientName').value,
                brand: document.getElementById('ingredientBrand').value,
                description: document.getElementById('ingredientDescription').value,
                qty_purchased: document.getElementById('ingredientQtyPurchased').value,
                qty_remaining: document.getElementById('ingredientQtyRemaining').value,
                unit_of_measure: document.getElementById('ingredientUnitOfMeasure').value,
                category: document.getElementById('ingredientCategory').value,
                allergen_flag: document.getElementById('ingredientAllergenFlag').checked,
            };

            let url = '/api/brand/' + document.getElementById('brandId').value + '/ingredients';
            let method = 'POST';

            if (currentAction === 'Edit') {
                url = '/api/brand/' + document.getElementById('brandId').value + '/ingredients/' + id;
                method = 'PUT';
            } else if (currentAction === 'Delete') {
                url = '/api/brand/' + document.getElementById('brandId').value + '/ingredients/' + id;
                method = 'DELETE';
            }

            fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json'
                    },
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
                        formMessage.textContent = currentAction === 'Delete' ? 'Ingredient deleted successfully.' : 'Ingredient saved successfully.';
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