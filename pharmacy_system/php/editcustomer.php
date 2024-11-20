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

.add-customer-form {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 400px;
    max-width: 100%;
    margin: auto;
}

.add-customer-form input[type="text"],
.add-customer-form input[type="submit"],
.add-customer-form input[type="radio"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.add-customer-form label {
    display: block;
    margin-bottom: 10px;
}

.add-customer-form input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}

.add-customer-form input[type="submit"]:hover {
    background-color: #0056b3;
}

.add-customer-form .error-message {
    color: red;
    margin-bottom: 10px;
}

    </style>
</header>
<?php
include('connection.php');
$id = $_GET['edit_id'];

$sql = "SELECT * FROM customers WHERE customer_id = '$id'";
$query = mysqli_query($conn, $sql);

$data = mysqli_fetch_assoc($query);

$errors = array(); // Initialize an array to store errors

if(isset($_POST['submit'])) {
    $username = $_POST['Username'];
    $age = $_POST['Uage'];
    $phone = $_POST['Uphone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    // Validate Username
    if(empty($username)){
        $errors[] = "Username is required";
    }

    // Validate Age as numeric and within a reasonable range
    if(!is_numeric($age) || $age <= 0 || $age > 150){
        $errors[] = "Invalid age";
    }

    // Validate Phone number
    // Adjust the regular expression based on your phone number format
    if(!preg_match("/^\d{10}$/", $phone)){
        $errors[] = "Invalid phone number format (10 digits)";
    }

    // Validate Address
    if(empty($address)){
        $errors[] = "Address is required";
    }

    // Validate Gender
    $allowedGenders = array("Male", "Female", "Other"); // Adjust values to match database
    if(!in_array(($gender), $allowedGenders)){
        $errors[] = "Invalid gender";
    }

    if(empty($errors)) {
        $sql = "UPDATE customers SET name = '$username', age = '$age', phone = '$phone', address = '$address', sex = '$gender' WHERE customer_id = '$id'";
        $result = mysqli_query($conn, $sql);

        if($result) {
            // Redirect to customers.php after successful update
            header("Location: customers.php");
            exit();
        } else {
            echo "Some error occurred!";
        }
    } else {
        foreach($errors as $error) {
            echo '<p class="error-message">' . $error . '</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="../css/addcustomer.css">
</head>
<body>
    <form method="post">
        <div class="add-customer-form">    
            <input type="text" name="Username" value="<?= $data['name'] ?>" required placeholder="Enter Username">
            <input type="text" name="Uage" value="<?= $data['age'] ?>" required placeholder="Enter Age">
            <input type="text" name="Uphone" value="<?= $data['phone'] ?>" required placeholder="Enter Phone">
            <input type="text" name="address" value="<?= $data['address'] ?>" required placeholder="Enter Address">
            <label>Gender</label>
            <input type="radio" name="gender" value="Male" <?= $data['sex'] == 'Male' ? 'checked' : '' ?>>Male
            <input type="radio" name="gender" value="Female" <?= $data['sex'] == 'Female' ? 'checked' : '' ?>>Female
            <input type="radio" name="gender" value="Other" <?= $data['sex'] == 'Other' ? 'checked' : '' ?>>Other
            <input type="submit" name="submit" value="Submit" class="form-btn">
        </div>
    </form>
</body>
</html>
