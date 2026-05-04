<?= view('header'); ?>
<?= view('navbar'); ?>

<div class="container-fluid mt-3 px-5">

    <h1>BOM Components</h1>

    <h5 class="text-muted">
        <?= esc($brandName) ?> — <?= esc($menuItem['item_name'] ?? '') ?>
    </h5>

    <h4><?= esc($menuItem['item_name'] ?? 'Menu Item') ?></h4>

    <table class="table table-striped table-bordered align-middle mt-3">
        <thead>
            <tr>
                <th>Ingredient ID</th>
                <th>Ingredient</th>
                <th>Quantity Required</th>
                <th>Unit of Measure</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bomItems as $item): ?>
                <tr>
                    <td><?= esc($item['ingredient_id']) ?></td>
                    <td><?= esc($item['name']) ?></td>
                    <td><?= esc($item['qty_required']) ?></td>
                    <td><?= esc($item['unit_of_measure']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>