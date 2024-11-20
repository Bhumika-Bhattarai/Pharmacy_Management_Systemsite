<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Drugs</title>
  <link rel="stylesheet" href="../css/adddrugs.css"/>
</head>
<body>
<?php
include('connection.php');
$errors = [];

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
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $mfg)) {
        $errors[] = "Invalid Manufacturing Date format (YYYY-MM-DD)";
    }

    // Validate Expiry Date (EXP) format (YYYY-MM-DD)
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $exp)) {
        $errors[] = "Invalid Expiry Date format (YYYY-MM-DD)";
    }

    // Compare Manufacturing Date and Expiry Date
    if (strtotime($mfg) >= strtotime($exp)) {
        $errors[] = "Manufacturing date must be before the expiry date";
    }

    // Validate Milligrams (MG) as numeric
    if(!is_numeric($mg)){
        $errors[] = "Milligrams must be a numeric value";
    }

    // Display errors if any
    if(!empty($errors)){
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    } else {
        // Insert into database
        $query = "INSERT INTO medicine (name,image,supplier,price,quantity,mfg_date,expirydate,mg) VALUES ('$name','$image','$supplier','$price','$quantity','$mfg','$exp','$mg')";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            // Redirect to drugs.php after successful insertion
            header("Location: drugs.php");
            exit();
        } else {
            echo "Data is not inserted successfully";
        }
    }
}
?>
<form method="post">
    <div class="add-customer-form">    
        <input type="text" name="Mname" id="Mname" required placeholder="Enter Medicine Name">
        <input type="file" name="Mimage" id="Mimage" accept="image/*" required>
        <input type="text" name="Supplier" id="Supplier" required placeholder="Enter Supplier">
        <input type="text" name="Mprice" id="Mprice" required placeholder="Enter Price (RS.0000000)">
        <input type="text" name="Mquantity" id="Mquantity" required placeholder="Enter quantity">
        <input type="date" name="MFG" id="MFG" required placeholder="Enter Manufacturing Date (e.g., YYYY-MM-DD)">
        <input type="date" name="EXP" id="EXP" required placeholder="Enter Expiry Date (e.g., YYYY-MM-DD)">
        <input type="text" name="MG" id="MG" required placeholder="Enter Milligrams (0000mg)">
        <input type="submit" name="submit" value="Submit" class="form-btn">
    </div>
</form>
</body>
</html>
