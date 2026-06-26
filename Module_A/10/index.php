<?php

$products = [
        [
                "name" => "Notebook",
                "category" => "Electronics",
                "price" => 3500,
                "stock" => 4
        ],
        [
                "name" => "Mouse",
                "category" => "Accessories",
                "price" => 120,
                "stock" => 15
        ],
        [
                "name" => "Keyboard",
                "category" => "Accessories",
                "price" => 250,
                "stock" => 3
        ],
        [
                "name" => "Monitor",
                "category" => "Electronics",
                "price" => 1800,
                "stock" => 8
        ]
];
$total = 0;
for ($i = 0; $i < count($products); $i++) {
    $product = $products[$i];
    $total += $product['price'] * $product['stock'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Product Inventory Dashboard</title>
    <style>
        tr.table-primary {
            --bs-table-bg: var(--bs-primary) !important;
        }
    </style>
</head>
<body>
<div class="container pt-5">
    <div class="shadow rounded-3 p-3">
        <h2 class="my-3">Product Inventory Dashboard</h2>
        <div class="row row-cols-2 g-2">
            <div class="col">
                <div class="rounded-3 p-3 bg-primary-subtle">
                    <p><strong>Total products</strong></p>
                    <p><?= count($products) ?></p>
                </div>
            </div>
            <div class="col">
                <div class="rounded-3 p-3 bg-primary-subtle">
                    <p><strong>Total Inventory Value</strong></p>
                    <p>$<?=number_format($total, '2')?></p>
                </div>
            </div>
        </div>
        <table class="table mt-3">
            <thead>
            <tr class="table-primary bg-primary">
                <th class="text-white">Product</th>
                <th class="text-white">Category</th>
                <th class="text-white">Price</th>
                <th class="text-white">Stock</th>
                <th class="text-white">Total Value</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $product): ?>
                <tr class="<?= $product['stock'] <= 5 ? 'table-danger text-danger' : '' ?>">
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['category'] ?></td>
                    <td>$<?= number_format($product['price'], 2) ?></td>
                    <td><?= $product['stock'] ?></td>
                    <td>$<?= number_format($product['stock'] * $product['price'], 2) ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
