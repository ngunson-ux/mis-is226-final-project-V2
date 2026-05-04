<?= view('header'); ?>
<?= view('navbar'); ?>

<div class="container mt-4">

    <h2>Add Menu Item - <?= esc($brandName) ?></h2>

    <form method="post" action="<?= base_url('add-menu/store') ?>" class="mt-4">

        <!-- Hidden Brand -->
        <input type="hidden" name="brandName" value="<?= esc($brandName) ?>">
        <div class="mb-3">
            <label class="form-label required">Brand</label>
            <select name="brand_id" class="form-control" required>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?= $brand['brand_id'] ?>"
                        <?= ($brand['brand_id'] == $brandId) ? 'selected' : '' ?>>
                        <?= esc($brand['brand_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Menu Name -->
        <div class="mb-3">
            <label class="form-label required">Menu Name</label>
            <input type="text" name="item_name" class="form-control" required>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label class="form-label required">Category</label>
            <input type="text" name="menu_category" class="form-control" required>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label class="form-label required">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>

        <!-- Availability -->
        <div class="mb-3">
            <label class="form-label required">Status</label>
            <select name="availability_status" class="form-control">
                <option value="available">Available</option>
                <option value="unavailable">Unavailable</option>
            </select>
        </div>

        <!-- Submit -->
        <div class="mt-4">
            <button type="submit" class="btn btn-success">
                Save Menu Item
            </button>

            <a href="<?= base_url('manage-menu') ?>?brandId=<?= esc($brandId) ?>&brandName=<?= urlencode($brandName) ?>"
               class="btn btn-secondary">
                Cancel
            </a>
        </div>

    </form>

</div>