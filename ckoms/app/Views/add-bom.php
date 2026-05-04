<?= $this->extend("templates/default") ?>
<?= $this->section("content") ?>
<?php if (isset($menuItemId)): ?>
    <div class="row mb-3">
        <div class="col">
            <button type="button" class="btn btn-success mt-1" aria-label="Add Ingredient"
                data-bs-toggle="offcanvas"
                data-bs-target="#ingredientDetails"
                aria-controls="ingredientDetails"
                data-bs-ingredient-action="Add"
                data-bs-ingredient-id=""
                data-bs-ingredient-name=""
                data-bs-ingredient-brand=""
                data-bs-ingredient-description=""
                data-bs-ingredient-qty-Required=""
                data-bs-ingredient-qty-purchased=""
                data-bs-ingredient-qty-remaining=""
                data-bs-ingredient-unit-of-measure=""
                data-bs-ingredient-category=""
                data-bs-ingredient-allergen-flag="">+ Add Ingredient</button>
            <button type="button" class="btn btn-primary mt-1" aria-label="View Basket"
                data-bs-toggle="offcanvas"
                data-bs-target="#basket">View Basket</button>
            <!-- Load search ingredients here -->
        </div>
        <div class="col">
            <form action="/add-bom/<?= $menuItemId ?>" method="get">
                <div class="input-group mb-3">
                    <select name="category" id="searchIngredientCategory" class="form-select">
                        <option value="" selected>Choose a Category</option>
                    </select>
                    <button aria-label="Search Ingredient Button" class="btn btn-primary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        <div class="row mb-3">
            <div class="col d-flex">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Actions</th>
                            <th scope="col">Ingredient ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Category</th>
                            <th scope="col">Allergen Flag</th>
                            <th scope="col">Unit of Measure</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        log_message('debug', 'Result data for AddBom view: ' . print_r($data, true));
                        $ingredients = $data['brandIngredients'] ?? [];
                        foreach ($ingredients as $ingredient) { ?>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-info mt-1" aria-label="View Ingredient"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#ingredientDetails"
                                        aria-controls="ingredientDetails"
                                        data-bs-ingredient-action="View"
                                        data-bs-ingredient-id="<?= $ingredient['ingredient_id'] ?>"
                                        data-bs-ingredient-name="<?= $ingredient['name'] ?>"
                                        data-bs-ingredient-brand="<?= $ingredient['brand'] ?>"
                                        data-bs-ingredient-description="<?= $ingredient['description'] ?>"
                                        data-bs-ingredient-category="<?= $ingredient['category'] ?>"
                                        data-bs-ingredient-qty-Required="<?= 0 ?>"
                                        data-bs-ingredient-unit-of-measure="<?= $ingredient['unit_of_measure'] ?>"
                                        data-bs-ingredient-allergen-flag="<?= $ingredient['allergen_flag'] ?>">View</button>
                                    <button type="button" class="btn btn-primary mt-1" aria-label="Select Ingredient"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#basket"
                                        aria-controls="basket"
                                        data-bs-ingredient-action="Select"
                                        data-bs-ingredient-id="<?= $ingredient['ingredient_id'] ?>"
                                        data-bs-ingredient-name="<?= $ingredient['name'] ?>"
                                        data-bs-ingredient-brand="<?= $ingredient['brand'] ?>"
                                        data-bs-ingredient-description="<?= $ingredient['description'] ?>"
                                        data-bs-ingredient-category="<?= $ingredient['category'] ?>"
                                        data-bs-ingredient-qty-Required="<?= 0 ?>"
                                        data-bs-ingredient-unit-of-measure="<?= $ingredient['unit_of_measure'] ?>"
                                        data-bs-ingredient-allergen-flag="<?= $ingredient['allergen_flag'] ?>">Select</button>
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
                                    <p><?= $ingredient['category'] ?></p>
                                </td>
                                <td>
                                    <p><?= $ingredient['allergen_flag'] ? 'Yes' : 'No' ?></p>
                                </td>
                                <td>
                                    <p><?= $ingredient['unit_of_measure'] ?></p>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="offcanvas offcanvas-end w-100" data-bs-backdrop="static" tabindex="-1" id="ingredientDetails" aria-labelledby="ingredientDetailsLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="ingredientDetailsLabel">Ingredient Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div id="ingredientFormMessage">
                        </div>
                        <form id="ingredientDetailsForm" class="needs-validation" novalidate>
                            <input type="hidden" id="ingredientId" name="ingredientId">
                            <div class="row">
                                <div class="col">
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
                                        <label for="ingredientCategory" class="form-label required">Category</label>
                                        <div class="has-validation">
                                            <input type="text" class="form-control" id="ingredientCategory" name="ingredientCategory" placeholder="Category" required>
                                            <div class="invalid-feedback">
                                                Please provide a category.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="ingredientAllergenFlag" name="ingredientAllergenFlag" value="1">
                                        <label class="form-check-label" for="ingredientAllergenFlag">Contains Allergen</label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ingredientQtyRequired" class="form-label required">Quantity Required</label>
                                        <div class="has-validation">
                                            <input type="number" min="0" step="any" class="form-control" id="ingredientQtyRequired" name="ingredientQtyRequired" value="1.00">
                                            <div class="invalid-feedback">
                                                Please provide a valid quantity Required.
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
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-success" id="ingredientDetailsFormSubmit" aria-label="Add To Basket"
                                        data-bs-ingredient-action="Add">
                                        + Add To Basket</button>
                                    <button type="button" class="btn btn-primary" aria-label="View Basket"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#basket">View Basket</button>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <div id="checkAddMoreIngredientsContainer" class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkAddMoreIngredients">
                                        <label class="form-check-label" for="checkAddMoreIngredients">
                                            Add More Ingredients After This
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="offcanvas offcanvas-end w-100" data-bs-backdrop="static" tabindex="-1" id="basket" aria-labelledby="basketLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="basketLabel">Basket Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div id="basketFormMessage">
                    </div>
                    <form id="basketDetailsForm" class="needs-validation" novalidate>
                        <input type="hidden" id="brandId" name="brandId" value="<?= isset($brandId) ? $brandId : '' ?>">
                        <input type="hidden" id="menuItemId" name="menuItemId" value="<?= isset($menuItemId) ? $menuItemId : '' ?>">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Ingredient ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Allergen</th>
                                    <th scope="col" class="form-label required">Quantity Required</th>
                                    <th scope="col">Unit of Measure</th>
                                </tr>
                            </thead>
                            <tbody id="basketTableBody">
                                <!-- Selected ingredients will be added here -->
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?= $this->endSection() ?>
    <?= $this->section("endScript") ?>
    <script>
        async function loadIngredientCategories() {
            const response = fetch(`${window.location.origin}/api/brand/${<?= $brandId ?>}/ingredients/categories`, {
                    method: 'GET',
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                }) // Replace with your actual endpoint URL
                .then(response => response.json()) // Parses JSON response into native JavaScript objects
                .then(data => {
                    const queryString = window.location.search;
                    const urlParams = new URLSearchParams(queryString);
                    const ingredientCategorySelect = document.getElementById("searchIngredientCategory");
                    data.forEach(category => {
                        const option = document.createElement("option");
                        option.value = category;
                        option.textContent = category;
                        if (category === urlParams.get('category')) {
                            option.selected = true;
                        }
                        ingredientCategorySelect.appendChild(option);
                    });
                }) // Handles the actual data
                .catch(error => console.error("Error:", error)); // Catches network-level errors
        }
        loadIngredientCategories();

        const offcanvasElement = document.getElementById("ingredientDetails");
        const form = document.getElementById("ingredientDetailsForm");
        let currentAction = '';

        offcanvasElement.addEventListener("show.bs.offcanvas", function(event) {
            const formMessage = document.getElementById("ingredientFormMessage");
            formMessage.innerHTML = '';

            form.classList.remove("was-validated");

            // Button that triggered the offcanvas
            const button = event.relatedTarget;
            currentAction = button.getAttribute("data-bs-ingredient-action");

            // Extract info from data-bs-* attributes
            const ingredientId = button.getAttribute("data-bs-ingredient-id");
            const brandId = button.getAttribute("data-bs-brand-id");
            const ingredientName = button.getAttribute("data-bs-ingredient-name");

            // Update the offcanvas content
            document.getElementById("ingredientName").value = ingredientName ?? "";
            document.getElementById("ingredientBrand").value = button.getAttribute("data-bs-ingredient-brand") ?? "";
            document.getElementById("ingredientDescription").value = button.getAttribute("data-bs-ingredient-description") ?? "";
            document.getElementById("ingredientQtyRequired").value = button.getAttribute("data-bs-ingredient-qty-Required") ?? "";
            document.getElementById("ingredientUnitOfMeasure").value = button.getAttribute("data-bs-ingredient-unit-of-measure") ?? "";
            document.getElementById("ingredientCategory").value = button.getAttribute("data-bs-ingredient-category") ?? "";
            document.getElementById("ingredientAllergenFlag").checked = button.getAttribute("data-bs-ingredient-allergen-flag") === '1';

            if (currentAction === "Add") {
                form.reset();
                // Enable form fields for edit mode
                form.querySelectorAll("input").forEach(
                    function(input) {
                        input.removeAttribute("readonly");
                        if (input.type === 'checkbox') {
                            input.style.setProperty("pointer-events", "auto");
                        }
                    }
                );
                offcanvasElement.querySelector(".offcanvas-title").textContent = 'Add New Ingredient To Basket';
                document.getElementById("checkAddMoreIngredientsContainer").style.display = 'inline-block';
            } else if (currentAction === "View") {
                form.querySelectorAll("input").forEach(
                    function(input) {
                        input.setAttribute("readonly", "readonly");
                        if (input.type === "checkbox") {
                            input.style.setProperty("pointer-events", "none");
                        }
                    }
                );
                offcanvasElement.querySelector(".offcanvas-title").textContent = "Add Ingredient To Basket'";
                document.getElementById("checkAddMoreIngredientsContainer").style.display = "none";
            }
        });

        form.addEventListener("submit", function(event) {
            event.preventDefault();

            const formMessage = document.getElementById("ingredientFormMessage");
            formMessage.innerHTML = '';

            if (!this.checkValidity()) {
                event.stopPropagation();
                this.classList.add("was-validated");
                return;
            }

            try {
                const rowId = addToBasket({
                    "ingredientId": document.getElementById("ingredientId").value,
                    "ingredientName": document.getElementById("ingredientName").value,
                    "ingredientBrand": document.getElementById("ingredientBrand").value,
                    "ingredientDescription": document.getElementById("ingredientDescription").value,
                    "ingredientQtyRequired": document.getElementById("ingredientQtyRequired").value,
                    "ingredientUnitOfMeasure": document.getElementById("ingredientUnitOfMeasure").value,
                    "ingredientCategory": document.getElementById("ingredientCategory").value,
                    "ingredientAllergenFlag": document.getElementById("ingredientAllergenFlag").checked ? '1' : '0'
                });

                formMessage.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div>Ingredient ${document.getElementById("ingredientName").value} added to basket successfully!</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;

                if (rowId !== null && !document.getElementById("checkAddMoreIngredients").checked) {
                    const ingredientOffcanvas = bootstrap.Offcanvas.getInstance(document.getElementById("ingredientDetails"));
                    ingredientOffcanvas.toggle();
                    const basketOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(document.getElementById("basket"));
                    const basketFormMessage = document.getElementById("basketFormMessage");
                    basketFormMessage.innerHTML = '';
                    basketOffcanvas.toggle();
                } else {
                    form.reset();
                    form.classList.remove("was-validated");
                }
            } catch (error) {
                console.error("Error adding ingredient to basket:", error);
                formMessage.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div>Error adding ingredient ${document.getElementById("ingredientName").value} to basket: ${error.message}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
                return;
            }
        });

        const offcanvasElement2 = document.getElementById("basket")
        const formBasket = document.getElementById("basketDetailsForm");

        offcanvasElement2.addEventListener("show.bs.offcanvas", function(event) {
            formBasket.classList.remove("was-validated");

            formMessage = document.getElementById("basketFormMessage");
            formMessage.innerHTML = '';

            // Button that triggered the offcanvas
            const button = event.relatedTarget;
            if (!button) {
                currentAction = 'Add';
            } else {
                currentAction = button.getAttribute("data-bs-ingredient-action");
            }

            if (currentAction === "Select") {
                // Extract info from data-bs-* attributes and update the offcanvas content
                rowId = addToBasket({
                    "ingredientId": button.getAttribute("data-bs-ingredient-id"),
                    "ingredientName": button.getAttribute("data-bs-ingredient-name"),
                    "ingredientBrand": button.getAttribute("data-bs-ingredient-brand"),
                    "ingredientDescription": button.getAttribute("data-bs-ingredient-description"),
                    "ingredientQtyRequired": 0,
                    "ingredientUnitOfMeasure": button.getAttribute("data-bs-ingredient-unit-of-measure"),
                    "ingredientCategory": button.getAttribute("data-bs-ingredient-category"),
                    "ingredientAllergenFlag": button.getAttribute("data-bs-ingredient-allergen-flag") === '1'
                });
                setTimeout(() => {
                    document.getElementById(`ingredients['${rowId}']['ingredientQtyRequired']`).focus();
                    document.getElementById(`ingredients['${rowId}']['ingredientQtyRequired']`).select();
                }, 500);
                return;
            }
        });

        formBasket.addEventListener("submit", function(event) {
            this.classList.remove("was-validated");
            formMessage = document.getElementById("basketFormMessage");
            formMessage.innerHTML = '';
            // Button that triggered the offcanvas
            event.preventDefault();
            let row = document.getElementById("basketTableBody").querySelector(".ingredient-row input:first-child");
            let validationMessage = null;
            if (row === null) {
                validationMessage = 'Menu item must have at least one ingredient.';
            }
            if (!this.checkValidity()) {
                validationMessage = 'Please enter a quantity that is greater than 0.';
            }
            if (validationMessage !== null) {
                event.stopPropagation();
                this.classList.add("was-validated");
                formMessage.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div>${validationMessage}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
                return;
            }

            brandId = document.getElementById("brandId").value;
            menuItemId = document.getElementById("menuItemId").value;

            fetch(`${window.location.origin}/api/brand/${brandId}/menu-item/${menuItemId}/ingredients`, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify(

                        Array.from(document.querySelectorAll("#basketTableBody .ingredient-row")).map(row => {
                            let ingredient = {
                                name: row.querySelector("input[id$=\"['ingredientName']\"]").value,
                                brand: row.querySelector("input[id$=\"['ingredientBrand']\"]").value,
                                description: row.querySelector("input[id$=\"['ingredientDescription']\"]").value,
                                category: row.querySelector("input[id$=\"['ingredientCategory']\"]").value,
                                allergen_flag: row.querySelector("input[id$=\"['ingredientAllergenFlag']\"]").value,
                                quantity_required: row.querySelector("input[id$=\"['ingredientQtyRequired']\"]").value,
                                unit_of_measure: row.querySelector("input[id$=\"['ingredientUnitOfMeasure']\"]").value
                            }
                            if (row.querySelector("input[id$=\"['ingredientId']\"]").value) {
                                ingredient["ingredient_id"] = row.querySelector("input[id$=\"['ingredientId']\"]").value;
                            }
                            return ingredient;
                        })
                    )
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText || 'Unknown error occurred while saving BOM details.');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(`Success: ${JSON.stringify(data)}`);
                    formMessage.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div>Ingredients added to the Menu Item successfully!</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        `;
                })
                .catch(error => {
                    console.error(`Error: ${JSON.stringify(error)}`);
                    formMessage.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div>Error saving BOM details: ${error.message}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `;
                    return;
                });
        });

        function addToBasket(ingredient) {
            ingredientId = ingredient.ingredientId;
            ingredientName = ingredient.ingredientName;
            ingredientBrand = ingredient.ingredientBrand;
            let rowId = "_" + hashCode(ingredientName + ingredientBrand);
            const offcanvasTableBody = document.getElementById("basketTableBody");
            let ingredientRow = offcanvasTableBody.querySelector(`tr#${rowId}`);
            if (ingredientRow === null) {
                offcanvasTableBody.insertAdjacentHTML("beforeend", `
                <tr id="${rowId}" class="ingredient-row">
                    <td><input class="form-control" id="ingredients['${rowId}']['ingredientId']" type="hidden" value="${ingredientId}">${ingredientId}</td>
                    <td><input class="form-control" id="ingredients['${rowId}']['ingredientName']" type="hidden" value="${ingredient.ingredientName}">${ingredient.ingredientName}</td>
                    <td><input class="form-control" id="ingredients['${rowId}']['ingredientBrand']" type="hidden" value="${ingredient.ingredientBrand}">${ingredient.ingredientBrand}</td>
                    <td><input class="form-control" id="ingredients['${rowId}']['ingredientCategory']" type="hidden" value="${ingredient.ingredientCategory}">${ingredient.ingredientCategory}</td>
                    <td><input class="form-control" id="ingredients['${rowId}']['ingredientAllergenFlag']" type="hidden" value="${ingredient.ingredientAllergenFlag}">${ingredient.ingredientAllergenFlag == '1' ? 'Yes' : 'No'}</td>
                    <td><input class="form-control" id="ingredients['${rowId}']['ingredientQtyRequired']" type="number" min="0.001" step="any" value="${ingredient.ingredientQtyRequired}"></td>
                    <td>
                        <input class="form-control" id="ingredients['${rowId}']['ingredientUnitOfMeasure']" type="hidden" value="${ingredient.ingredientUnitOfMeasure}">
                        <input class="form-control" id="ingredients['${rowId}']['ingredientDescription']" type="hidden" value="${ingredient.ingredientDescription}">
                        ${ingredient.ingredientUnitOfMeasure}        
                    </td>
                </tr>
                `);
                ingredientRow = offcanvasTableBody.querySelector(`tr#${rowId}`);
            } else {
                document.getElementById(`ingredients['${rowId}']['ingredientQtyRequired']`).value = parseInt(document.getElementById(`ingredients['${rowId}']['ingredientQtyRequired']`).value) + ingredient.ingredientQtyRequired;
            }
            return rowId;
        }

        function hashCode(str) {
            let hash = 0;
            for (let i = 0; i < str.length; i++) {
                const char = str.charCodeAt(i);
                hash = (hash << 5) - hash + char;
                hash |= 0; // Convert to 32bit integer
            }
            return hash;
        }

        fetch(`${window.location.origin}/api/brand/${<?= $brandId ?>}/menu-item/${<?= $menuItemId ?>}/ingredients`, {
                method: 'GET',
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(response => response.json())
            .then(data => {
                data.forEach(ingredient => {
                    addToBasket({
                        ingredientId: ingredient.ingredient_id,
                        ingredientName: ingredient.name,
                        ingredientBrand: ingredient.brand,
                        ingredientDescription: ingredient.description,
                        ingredientCategory: ingredient.category,
                        ingredientAllergenFlag: ingredient.allergen_flag,
                        ingredientQtyRequired: ingredient.qty_required,
                        ingredientUnitOfMeasure: ingredient.unit_of_measure
                    });
                });
            }) // Handles the actual data
            .catch(error => {
                    console.error(`Error: ${JSON.stringify(error)}`);
                    formMessage.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div>Error saving BOM details: ${error.message}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `;
                    return;
                });
    </script>
<?php else: ?>
    <div class="modal fade" id="selectMenuItemModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="selectMenuItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="selectMenuForm" method="get" action="/add-bom" class="needs-validation" novalidate>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 form-label required" id="selectMenuItemModalLabel">Select Menu Item</h1>
                    </div>
                    <div class="modal-body">
                        <select id="selectMenu" class="form-select" aria-label="Select Menu Item" required>
                            <option selected value="">Select Menu Item</option>
                            <option value="20001">One</option>
                            <option value="20002">Two</option>
                            <option value="20003">Three</option>
                            <option value="20004">Four</option>
                            <option value="20005">Five</option>
                            <option value="20006">Six</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a menu item to add ingredients to.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Select</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const selectMenuItemModal = bootstrap.Modal.getOrCreateInstance(document.getElementById("selectMenuItemModal"));
        selectMenuItemModal.show();

        form = document.getElementById("selectMenuForm");
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            if (!this.checkValidity()) {
                event.stopPropagation();
                this.classList.add("was-validated");
                return;
            }
            const selectedMenuItemId = document.getElementById("selectMenu").value;
            window.location.href = `/add-bom/${selectedMenuItemId}`;
        });
    </script>
<?php endif; ?>
<?= $this->endSection() ?>