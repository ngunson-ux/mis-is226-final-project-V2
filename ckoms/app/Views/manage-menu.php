<?= $this->extend("templates/default") ?>
<?= $this->section("content") ?>
<div class="container-fluid mt-3 px-5">

    <div class="row mb-3 align-items-center">

        <!-- LEFT: New Menu Item -->
        <div class="col-auto">
            <a href="<?= base_url('add-menu') ?><?= !empty($brandId) ? '?brandId=' . esc($brandId) . '&brandName=' . urlencode($brandName) : '' ?>"
            class="btn btn-success">
                + New Menu Item
            </a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Menu ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>BOM</th>
            </tr>
        </thead>
        <tbody>
            <?php $items = $result['data'] ?? []; ?>

            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= $item['menu_item_id'] ?></td>

                    <!-- VIEW BOM (read-only) -->
                    <td>
                        <a href="<?= base_url('view-bom/' . $item['menu_item_id']) ?>"
                        class="text-decoration-underline">
                            <?= esc($item['item_name']) ?>
                        </a>
                    </td>

                    <td><?= $item['menu_category'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td><?= $item['availability_status'] ?></td>

                    <!-- EDIT BOM -->
                    <td>
                        <a class="btn btn-primary btn-sm px-3"
                        href="<?= base_url('add-bom/' . $item['menu_item_id']) ?>?brandId=<?= $item['brand_id'] ?>&brandName=Brand<?= $item['brand_id'] ?>">
                            Update
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">
                    <?= $result['pager']->links() ?>
                </td>
            </tr>
        </tfoot>
    </table>

</div>
<?php $this->endSection() ?>