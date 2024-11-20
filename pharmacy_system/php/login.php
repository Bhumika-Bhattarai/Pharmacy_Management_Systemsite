
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login.css"/>
</head>
<body>

<?php

    if(isset($_SESSION['user'])) {
        include('dashboard.php');
    }


?>

<?php
    $errName=$errPassword="";
    if(isset($_POST['submit'])){
        $conn=mysqli_connect('localhost:3308','root','','pharmacy_system_db') or die("unable to connect");
        $username=$_POST['username'];
        $password=$_POST['password'];
       

        if(empty($username) || empty($password)) {
            echo "Required Fields should not be empty!";
        } else {
            $sql = "SELECT * FROM admin_credentials WHERE username = '$username' AND password = '$password' LIMIT 1";
            $res = mysqli_query($conn, $sql);

            if(mysqli_num_rows($res) == 1) {
                $row = mysqli_fetch_assoc($res);
                $_SESSION['user'] = $username;
                echo "Logged in!";
                // redirect 
                header("Location: dashboard.php"); 
            } else {
                // alert msg
                echo "<script>alert('Incorrect password and username!!')</script>";
            }
        }
      
    }
?>
 <div class=form>
    <h1>Login Form</h1>
    <form action="" method="post">
        <br><br>
        Username: <input type= "text" id="user" name="username"  placeholder="E.g. Bhumika Bhattarai" class="input-responsive" required><br>
        <span><?php echo $errName;?></spam><br>
        Password: <input type="password" id="pass"name="password"  placeholder="E.g. ********" class="input-responsive" required><br><br>
        <input type="submit" id="submit" name="submit" value="login">
    </form>
 </div>
</body>
</html>