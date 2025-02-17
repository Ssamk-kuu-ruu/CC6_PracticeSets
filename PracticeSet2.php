<?php

$fruits = ["Apple", "Banana", "Mango", "Pineapple", "Kiwi"];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Fruit List</title>
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
        ol {
            text-align: left;
            padding-left: 40px;
        }
        h2 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>List of Fruits</h2>
        <ol>
            <?php for ($i = 0; $i < count($fruits); $i++): ?>
                <li><?php echo $fruits[$i]; ?></li>
            <?php endfor; ?>
        </ol>
    </div>
</body>
</html>
