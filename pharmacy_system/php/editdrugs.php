<head>
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

.add-customer-form {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 400px;
    max-width: 100%;
    margin: auto;
}

.add-customer-form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

.add-customer-form input[type="text"],
.add-customer-form input[type="file"],
.add-customer-form input[type="submit"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.add-customer-form input[type="submit"] {
    background-color: #28a745;
    color: #fff;
    border: none;
    cursor: pointer;
}

.add-customer-form input[type="submit"]:hover {
    background-color: #218838;
}

.errors {
    color: red;
    margin-bottom: 20px;
}

    </style>
</head><?php
include('connection.php');

$id = $_GET['edit_id'];

$sql = "SELECT * FROM medicine WHERE id = '$id'";
$query = mysqli_query($conn, $sql);

$data = mysqli_fetch_assoc($query);

$errors = array(); // Initialize an array to store errors

if(isset($_POST['submit'])){
    $name = $_POST['Mname'];
    $image = $_POST['Mimage'];
    $supplier = $_POST['Supplier'];
    $price = $_POST['Mprice'];
    $quantity = $_POST['Mquantity'];
    $mfg = $_POST['MFG'];
    $exp = $_POST['EXP'];
    $mg = $_POST['MG'];

    // Validate Medicine Name
    if(empty($name)){
        $errors[] = "Medicine Name is required";
    }

    // Validate Image URL
    if(empty($image)){
        $errors[] = "Image URL is required";
    }

    // Validate Supplier
    if(empty($supplier)){
        $errors[] = "Supplier is required";
    }

    // Validate Price as numeric
    if(!is_numeric($price)){
        $errors[] = "Price must be a numeric value";
    }

    // Validate Manufacturing Date (MFG) format (YYYY-MM-DD)
    if(!preg_match("/^\d{4}-\d{2}-\d{2}$/", $mfg)){
        $errors[] = "Invalid Manufacturing Date format (YYYY-MM-DD)";
    }

    // Validate Expiry Date (EXP) format (YYYY-MM-DD)
    if(!preg_match("/^\d{4}-\d{2}-\d{2}$/", $exp)){
        $errors[] = "Invalid Expiry Date format (YYYY-MM-DD)";
    }

    // Compare Manufacturing Date and Expiry Date
    if(strtotime($mfg) >= strtotime($exp)) {
        $errors[] = "Manufacturing date must be before the expiry date";
    }

    // Validate Milligrams (MG) as numeric
    if(!is_numeric($mg)){
        $errors[] = "Milligrams must be a numeric value";
    }

    if(empty($errors)) {
        $sql = "UPDATE medicine SET name = '$name', image = '$image', supplier = '$supplier', price = '$price', quantity = '$quantity', mfg_date = '$mfg', expirydate = '$exp', mg = '$mg' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if($result) {
            echo "Updated successfully!";
            header("Location:drugs.php");
            exit();
        } else {
            echo "Some error occurred!";
        }
    } else {
        foreach($errors as $error) {
            echo $error . '<br>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <!-- Include your CSS file here -->
    <link rel="stylesheet" href="../css/home.css"/>
</head>
<body>
  
    <form method="post">
        <div class="add-customer-form">    
            <label>Name</label>
            <input type="text" name="Mname" value="<?= $data['name'] ?>" required placeholder="Enter Medicine Name"><br>
            <label>Image</label>
            <input type="file" name="Mimage" value="<?= $data['image'] ?>" accept="image/*" required><br>
            <label>supplier</label>
            <input type="text" name="Supplier" value="<?= $data['supplier'] ?>" required placeholder="Enter Supplier"><br>
            <label>Price</label>
            <input type="text" name="Mprice" value="<?= $data['price'] ?>" required placeholder="Enter Price (RS.0000000)"><br>
            <label>Quantity</label>
            <input type="text" name="Mquantity" value="<?= $data['quantity'] ?>" required placeholder="Enter quantity"><br>
            <label>mfg date</label>
            <input type="date" name="MFG" value="<?= $data['mfg_date'] ?>" required placeholder="Enter Manufacturing Date (e.g., YYYY-MM-DD)"><br>
            <label>exp date</label>
            <input type="date" name="EXP" value="<?= $data['expirydate'] ?>" required placeholder="Enter Expiry Date (e.g., YYYY-MM-DD)"><br>
            <label>MG</label>
            <input type="text" name="MG" value="<?= $data['mg'] ?>" required placeholder="Enter Milligrams (0000mg)"><br>
            <input type="submit" name="submit" value="Submit" class="form-btn">
        </div>
    </form>
</body>
</html>
