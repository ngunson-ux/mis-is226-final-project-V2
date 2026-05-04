<?php $this->extend('templates/default') ?>
<?php $this->section('content') ?>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>City</th>
        <th>Status</th>
    </tr>

    <?php foreach ($customers as $c): ?>
    <tr>
        <td><?= $c->customer_id ?></td>
        <td><?= $c->first_name ?> <?= $c->last_name ?></td>
        <td><?= $c->email_address ?></td>
        <td><?= $c->mobile_number ?></td>
        <td><?= $c->city ?></td>
        <td><?= $c->account_status ?></td>
    </tr>
    <?php endforeach; ?>

</table>
<?php $this->endSection() ?>