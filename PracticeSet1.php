<?php

function squareRoot($num) {
    $x = $num;
    $y = 1;
    $epsilon = 0.000001;

    while ($x - $y > $epsilon) {
        $x = ($x + $y) / 2;
        $y = $num / $x;
    }

    return $x;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $side1 = isset($_POST['side1']) ? floatval($_POST['side1']) : 0;
    $side2 = isset($_POST['side2']) ? floatval($_POST['side2']) : 0;
    $side3 = isset($_POST['side3']) ? floatval($_POST['side3']) : 0;

    if ($side1 > 0 && $side2 > 0 && $side3 > 0 && ($side1 + $side2 > $side3) && ($side1 + $side3 > $side2) && ($side2 + $side3 > $side1)) {
        $s = ($side1 + $side2 + $side3) / 2;
        $area = squareRoot($s * ($s - $side1) * ($s - $side2) * ($s - $side3));
        $formattedArea = number_format($area, 2);
    } else {
        $formattedArea = "Invalid triangle sides";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Triangle Area Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        .container {
            background: white;
            max-width: 400px;
            margin: auto;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        h3 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Triangle Area Calculator</h2>
        <form method="POST">
            <label>Side 1:</label>
            <input type="text" name="side1" required>
            <label>Side 2:</label>
            <input type="text" name="side2" required>
            <label>Side 3:</label>
            <input type="text" name="side3" required>
            <button type="submit">Calculate Area</button>
        </form>
        
        <?php if (isset($formattedArea)): ?>
            <h3>Triangle Area: <?php echo $formattedArea; ?> square units</h3>
        <?php endif; ?>
    </div>
</body>
</html>
