<?php

$students = [
        [
                "name" => "John",
                "grades" => [8, 7, 9],
                "attendance" => 92
        ],
        [
                "name" => "Mary",
                "grades" => [5, 6, 4],
                "attendance" => 75
        ],
        [
                "name" => "Michael",
                "grades" => [9, 8, 10],
                "attendance" => 98
        ],
        [
                "name" => "Sarah",
                "grades" => [6, 7, 8],
                "attendance" => 70
        ]
];
$avg = 0;
$total = 0;
$totalAvg = 0;
foreach ($students as $key => $student) {
    $studentAvg = 0;
    $total = 0;
    foreach ($student['grades'] as $grade) {
        $total += $grade;
    }
    $studentAvg = $total / count($student['grades']);
    $totalAvg += $studentAvg;
    $students[$key]['avg'] = $studentAvg;
    $students[$key]['approved'] = $studentAvg >= 7 && $student['attendance'] >= 75;
}
$avg = $totalAvg / count($students);
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
        <h2 class="my-3">Student Grade Report</h2>
        <div class="row row-cols-2 g-2">
            <div class="col">
                <div class="rounded-3 p-3 bg-primary-subtle">
                    <p><strong>Total products</strong></p>
                    <p><?= count($students) ?></p>
                </div>
            </div>
            <div class="col">
                <div class="rounded-3 p-3 bg-primary-subtle">
                    <p><strong>Class Average</strong></p>
                    <p><?= number_format($avg, 2) ?></p>
                </div>
            </div>
        </div>
        <table class="table mt-3">
            <thead>
            <tr class="table-primary bg-primary">
                <th class="text-white">Student</th>
                <th class="text-white">Grades</th>
                <th class="text-white">Attendance</th>
                <th class="text-white">Average</th>
                <th class="text-white">Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($students as $student): ?>
                <tr class="<?= $student['approved'] ? 'table-success' : 'table-danger' ?>">
                    <td><?= $student['name'] ?></td>
                    <td><?= implode(', ', $student['grades']) ?></td>
                    <td><?= $student['attendance'] ?>%</td>
                    <td><?= number_format($student['avg'], 2) ?></td>
                    <td><?= $student['approved'] ? 'Approved' : 'Failed' ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
