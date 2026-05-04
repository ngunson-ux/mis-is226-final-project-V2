<?php $this->extend('templates/default') ?>
<?php $this->section('content') ?>

<?php foreach ($invoices as $inv): ?>

    <h3>Invoice #<?= $inv->sales_invoice_id ?></h3>

    <p>
        Customer: <?= $inv->first_name ?> <?= $inv->last_name ?><br>
        Status: <?= $inv->order_status ?><br>
        Delivery Fee: <?= $inv->total_delivery_fee ?><br>
        Total Amount: <?= $inv->total_amount ?><br>
        Address: <?= $inv->delivery_address ?><br>
        Date: <?= $inv->date_created ?>
    </p>

    <table border="1" cellpadding="10">
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Line Total</th>
        </tr>

        <?php foreach ($orderLines as $line): ?>
            <?php if ($line->sales_invoice_id == $inv->sales_invoice_id): ?>
                <tr>
                    <td><?= $line->item_name ?></td>
                    <td><?= $line->quantity ?></td>
                    <td><?= $line->unit_price ?></td>
                    <td><?= $line->line_total ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>

    <hr>

<?php endforeach; ?>

<?php $this->endSection() ?>
