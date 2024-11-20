<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
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

        .edit-supplier-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
            margin: auto;
        }

        .edit-supplier-form input[type="text"],
        .edit-supplier-form input[type="email"],
        .edit-supplier-form input[type="submit"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .edit-supplier-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .edit-supplier-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
  
    <div class="edit-supplier-form">
        <h2>Edit Supplier</h2>
        <form method="post">
            <label for="Sname">Name</label>
            <input type="text" id="Sname" name="Sname" value="<?= isset($supplier_data['Sname']) ? htmlspecialchars($supplier_data['Sname']) : '' ?>" required placeholder="Enter Supplier Name"><br>
            <label for="Sphone">Phone</label>
            <input type="text" id="Sphone" name="Sphone" value="<?= isset($supplier_data['Sphone']) ? htmlspecialchars($supplier_data['Sphone']) : '' ?>" required placeholder="Enter Supplier Phone"><br>
            <label for="Semail">Email</label>
            <input type="email" id="Semail" name="Semail" value="<?= isset($supplier_data['Semail']) ? htmlspecialchars($supplier_data['Semail']) : '' ?>" required placeholder="Enter Supplier Email"><br>
            <label for="Saddress">Address</label>
            <input type="text" id="Saddress" name="Saddress" value="<?= isset($supplier_data['Saddress']) ? htmlspecialchars($supplier_data['Saddress']) : '' ?>" required placeholder="Enter Supplier Address"><br>
            <input type="submit" name="submit" value="Update">
        </form>
    </div>

</body>
</html>

<?php
// Include the connection file
include('connection.php');

// Check if the supplier ID is provided via GET parameter
if(isset($_GET['edit_id'])) {
    $supplier_id = $_GET['edit_id'];

    // Fetch the supplier details based on the supplier ID
    $select_query = "SELECT * FROM supplier WHERE supplier_id = '$supplier_id'";
    $query_result = mysqli_query($conn, $select_query);

    if ($query_result) {
        // Fetch the supplier details as an associative array
        $supplier_data = mysqli_fetch_assoc($query_result);
    } else {
        echo 'Error fetching supplier data: ' . mysqli_error($conn);
        $supplier_data = array(); // Initialize an empty array to avoid warnings
    }
} else {
    // Redirect to supplier.php if no supplier ID is provided
    header("Location: supplies.php");
    exit();
}

// Handle form submission for updating supplier details
if(isset($_POST['submit'])) {
    // Retrieve the form data
    $Sname = $_POST['Sname'];
    $Sphone = $_POST['Sphone'];
    $Semail = $_POST['Semail'];
    $Saddress = $_POST['Saddress'];

    // Update the supplier details in the database
    $update_query = "UPDATE supplier SET Sname='$Sname', Sphone='$Sphone', Semail='$Semail', Saddress='$Saddress' WHERE supplier_id='$supplier_id'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        // Redirect to supplies.php after successful update
        header("Location: supplies.php");
        exit();
    } else {
        echo "Error updating supplier data: " . mysqli_error($conn);
    }
}
?>
