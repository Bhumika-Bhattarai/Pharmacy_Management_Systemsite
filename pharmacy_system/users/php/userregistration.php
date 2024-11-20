<?php
session_start();
include('connection.php');

if (isset($_SESSION['user_type'])) {
    header("Location: userlogin.php");
    exit();
}

$errors = array();

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $sex = isset($_POST['gender']) ? $_POST['gender'] : '';
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Validation
    if (empty($name)) {
        $errors[] = 'Name is required';
    }

    if (empty($age)) {
        $errors[] = 'Age is required';
    } elseif (!is_numeric($age)) {
        $errors[] = 'Age must be a number';
    }

    if (empty($phone)) {
        $errors[] = 'Phone is required';
    } elseif (!preg_match('/^\d{10}$/', $phone)) {
        $errors[] = 'Phone must be a 10-digit number';
    }

    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is not valid';
    }

    if (empty($address)) {
        $errors[] = 'Address is required';
    }

    if (empty($sex)) {
        $errors[] = 'Sex is required';
    }

    if (empty($password)) {
        $errors[] = 'Password is required';
    }

    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match';
    }

    // If no errors, insert into the database
    if (empty($errors)) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $insert_query = "INSERT INTO customers (name, age, phone, email, address, sex, password) VALUES ('$name', '$age', '$phone', '$email', '$address', '$sex', '$password_hash')";
        mysqli_query($conn, $insert_query);
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        header('location: userlogin.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Now</title>
    <link rel="stylesheet" href="../css/userregistration.css" />
    <!-- Add your CSS styles for the registration page here -->
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Register Now</h3>
            <?php
            if (!empty($errors)) {
                echo '<div class="error-container">';
                foreach ($errors as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
                echo '</div>';
            }
            ?>
            <input type="text" name="name" placeholder="Enter your name">
            <input type="text" name="age" placeholder="Enter your age">
            <input type="text" name="phone" placeholder="Enter your phone">
            <input type="text" name="email" placeholder="Enter your email">
            <input type="text" name="address" placeholder="Enter your address">
            <input type="password" name="password" placeholder="Enter your password">
            <input type="password" name="confirm_password" placeholder="Confirm your password">
            <label>Gender</label>
            <input type="radio" name="gender" value="male">Male
            <input type="radio" name="gender" value="female">Female
            <input type="radio" name="gender" value="other">Other
            <input type="submit" name="submit" value="Register Now" class="form-btn">
            <p>Already have an account? <a href="userlogin.php">Login Now</a></p>
        </form>
    </div>
</body>
</html>
