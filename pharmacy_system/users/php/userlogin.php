<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../css/userlogin.css" />
    
</head>
<body>

<?php
session_start();
include('connection.php');

if (isset($_SESSION['user_type'])) {
    header("Location: home.php");
    exit();
}

$error = array();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];    

    $select = "SELECT * FROM customers WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row['password'])) {
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                header('location: home.php');
                exit();
            } else {
                $error[] = 'Incorrect email or password!';
            }
        } else {
            $error[] = 'Incorrect email or password!';
        }
    } else {
        $error[] = 'Database query error!';
    }
}
?>

<div class="form-container">
    <form action="" method="post">
        <h3>Login now</h3>
        <?php
        if (!empty($error)) {
            echo '<div class="error-container">';
            foreach ($error as $msg) {
                echo '<span class="error-msg">' . $msg . '</span>';
            }
            echo '</div>';
        }
        ?>
        <input type="email" name="email" required placeholder="Enter your email">
        <input type="password" name="password" required placeholder="Enter your password">
        <input type="submit" name="submit" value="Login now" class="form-btn">
        <p>Don't have an account? <a href="userregistration.php">Register Now</a></p>
    </form>
</div>
</body>
</html>
