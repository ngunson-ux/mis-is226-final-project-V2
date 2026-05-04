<?= view('header'); ?>
<?= view('navbar'); ?>

<div class="container-fluid mt-3 px-5">

    <div class="row mb-3 align-items-center">
        <div class="col-auto">
            <a href="<?= base_url('brand-selection') ?>" class="btn btn-outline-primary">
                <i class="bi bi-house"></i> Home
            </a>
        </div>

        <div class="col text-center">
            <h1 class="mb-0">Inventory Days Level Report</h1>
        </div>

        <div class="col-auto"></div>
    </div>

    <form method="get" action="<?= base_url('inventory-days-report') ?>" class="mb-3">

        <label class="form-label">View by:</label>
        <select name="period" class="form-select w-auto d-inline-block">
            <option value="day" <?= ($period ?? '') === 'day' ? 'selected' : '' ?>>Day</option>
            <option value="month" <?= ($period ?? '') === 'month' ? 'selected' : '' ?>>Month</option>
            <option value="year" <?= ($period ?? '') === 'year' ? 'selected' : '' ?>>Year</option>
        </select>

        <label class="form-label ms-3">Stockout Status:</label>
        <select name="stockout_filter" class="form-select w-auto d-inline-block">
            <option value="" <?= ($stockoutFilter ?? '') === '' ? 'selected' : '' ?>>All</option>
            <option value="critical" <?= ($stockoutFilter ?? '') === 'critical' ? 'selected' : '' ?>>Critical: 0–3 days</option>
            <option value="warning" <?= ($stockoutFilter ?? '') === 'warning' ? 'selected' : '' ?>>Warning: 4–7 days</option>
            <option value="healthy" <?= ($stockoutFilter ?? '') === 'healthy' ? 'selected' : '' ?>>Healthy: More than 7 days</option>
            <option value="no_usage" <?= ($stockoutFilter ?? '') === 'no_usage' ? 'selected' : '' ?>>No usage yet</option>
        </select>

        <button type="submit" class="btn btn-primary ms-2">Filter</button>

    </form>

    <table class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th>Period</th>
                <th>Ingredient ID</th>
                <th>Ingredient</th>
                <th>Current Stock</th>
                <th>UOM</th>
                <th>Total Restock</th>
                <th>Total Usage</th>
                <th>Active Days</th>
                <th>Estimated Days Before Stockout</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td><?= esc($record['report_period'] ?? 'No Transactions') ?></td>
                    <td><?= esc($record['ingredient_id']) ?></td>
                    <td><?= esc($record['name']) ?></td>
                    <td><?= esc($record['qty_remaining']) ?></td>
                    <td><?= esc($record['unit_of_measure']) ?></td>
                    <td><?= esc($record['total_restock']) ?></td>
                    <td><?= esc($record['total_usage']) ?></td>
                    <td><?= esc($record['active_days']) ?></td>
                    <td>
                        <?= $record['estimated_days_before_stockout'] !== null
                            ? esc($record['estimated_days_before_stockout']) . ' days'
                            : 'No usage yet' ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>