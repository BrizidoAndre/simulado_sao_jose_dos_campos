<?php

/* Write your code here */
$isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
if ($isPost) {
    $class = 'normal';
    $weight = $_POST['weight'] ?? 0;
    $height = $_POST['height'] ?? 0;
    $bmi = number_format($weight / ($height / 100) ** 2, 2);
    if ($bmi < 18.5) {
        $class = 'Underweight';
    } else if ($bmi < 25) {
        $class = 'Normal weight';
    } else if ($bmi < 30) {
        $class = 'Overweight';
    } else {
        $class = 'Obesity';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator</title>

    <style>

        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f3f4f6;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        input {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        button {
            padding: 12px;
            border: none;
            background: #2563eb;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }

        .result {
            margin-top: 24px;
            padding: 16px;
            background: #f9fafb;
            border-radius: 8px;
        }

    </style>
</head>
<body>

<div class="container">

    <h1>BMI Calculator</h1>

    <form method="POST">

        <input
                type="number"
                step="0.01"
                name="weight"
                placeholder="Enter your weight (kg)"
                required
        >

        <input
                type="number"
                step="1"
                name="height"
                placeholder="Enter your height (cm)"
                required
        >

        <button type="submit">
            Calculate BMI
        </button>

    </form>

    <?php if ($isPost): ?>
        <div class="result">
            <h3>Result</h3>

            <p>
                <strong>BMI:</strong>
                <?= $bmi ?>
            </p>

            <p>
                <strong>Classification:</strong>
                <?= $class ?>
            </p>
        </div>
    <?php endif ?>
</div>

</body>
</html>