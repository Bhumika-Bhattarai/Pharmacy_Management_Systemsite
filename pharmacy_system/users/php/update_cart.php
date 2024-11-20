<header>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 400px;
    max-width: 100%;
    margin: auto;
}

form div {
    margin-bottom: 10px;
}

form div label {
    display: inline-block;
    width: 100px;
    font-weight: bold;
}

form div input[type="text"],
form div input[type="number"] {
    width: calc(100% - 110px);
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

form div input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 4px;
    font-size: 16px;
}

form div input[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</header>
<?php
session_start();
$name = $_GET['name'];

$data = [];
foreach ($_SESSION['cart'] as $arr) {
    if ($arr['name'] == $name) {
        $data = $arr;
        break;
    }
}

if (isset($_POST['update_cart'])) {
    $qty = $_POST['quantity'];

    foreach($_SESSION['cart'] as &$arr) {
        if ($arr['name'] == $name) {
            $arr['quantity'] = $qty;
            header("location: all_cart.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Cart</title>
    <link rel="stylesheet" href="update_cart.css">
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= $data['name'] ?>" required readonly>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?= $data['price'] ?>" required readonly>
        </div>
        <div>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" min= "1" name="quantity" value="<?= $data['quantity'] ?>" required>
        </div>
        <input type="submit" name="update_cart" value="Update Cart">
    </form>
</body>
</html>
