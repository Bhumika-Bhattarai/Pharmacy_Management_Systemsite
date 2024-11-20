<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Carts</title>
    <link rel="stylesheet" href="../../css/supplies.css">
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 40px auto;
            width: 80%;
            max-width: 1200px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .total-section {
            margin-top: 20px;
            text-align: right;
        }

        .total-box {
            display: inline-block;
            border: 1px solid #dddddd;
            padding: 20px;
            background-color: #f9f9f9;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .checkout-button {
            display: block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .checkout-button:hover {
            background-color: #0056b3;
        }

a.update-button, a.delete-button {
    display: inline-block;
    padding: 8px 16px;
    border: 1px solid transparent;
    border-radius: 4px;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
    font-weight: bold;
    transition: all 0.3s ease;
}

a.update-button {
    background-color: #4CAF50;
    color: white;
}
a.delete-button {
    background-color: #f44336;
    color:white;}
a.update-button:hover, a.delete-button:hover {
    opacity: 0.8;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>All Items</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       session_start();
                       $counter = 0;
                       $totalAmount = 0;
                       if (!empty($_SESSION['cart'])) {

                           foreach ($_SESSION['cart'] as $arr) {
                               $counter++;
                               $quantity = (int)$arr['quantity'];
                               $price = $arr['price'];
                               $totalAmount += $quantity * $price;
                    ?>
                    <tr>
                        <td><?= $counter ?></td>
                        <td><?= htmlspecialchars($arr['name']) ?></td>
                        <td><?= htmlspecialchars($arr['quantity']) ?></td>
                        <td><?= htmlspecialchars($arr['price']) ?></td>
                        <td>
                                <a class="update-button" href="update_cart.php?name=<?= $arr['name'] ?>">Update</a>
                                <a class="delete-button" href="delete_cart.php?name=<?= $arr['name'] ?>">Delete</a>
                        </td>

                    </tr>
                    <?php
                            }
                        } else {
                            echo '<tr><td colspan="4" style="text-align:center;">No items in the cart</td></tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="total-section">
        <div class="total-section">
            <div class="total-box">
                Total Amount: <?= number_format($totalAmount, 2) ?>
                <a href="checkout.php?total_amt=<?= $totalAmount ?>" class="checkout-button">Checkout</a>
            </div>
        </div>
        </div>
    </div>
</body>
</html>
