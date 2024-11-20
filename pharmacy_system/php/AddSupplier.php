<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/addsupplier.css"/>
  <?php
    include('connection.php');
    if(isset($_POST['submit'])){
        $Sname = $_POST['Sname'];
        $Sphone = $_POST['Sphone'];
        $Semail = $_POST['Semail'];
        $Saddress = $_POST['Saddress'];

        // Validate Username
        if(empty($Sname)){
            $errors[] = "Username is required";
        }

        // Validate Phone number
        if(!preg_match("/^\d{10}$/", $Sphone)){
            $errors[] = "Invalid phone number format (10 digits)";
        }

        // Validate Email
        if(!filter_var($Semail, FILTER_VALIDATE_EMAIL)){
            $errors[] = "Invalid email format";
        }

        // Validate Address
        if(empty($Saddress)){
            $errors[] = "Address is required";
        }

        if(empty($errors)){
            $query = "INSERT INTO supplier (Sname, Sphone, Semail, Saddress) VALUES ('$Sname', $Sphone, '$Semail', '$Saddress')";
            $query_run = mysqli_query($conn, $query);

            if($query_run){
                echo '<script>alert("Data is inserted successfully");</script>';
                header("Location:supplies.php");
            }else{
                echo '<script>alert("Data is not inserted");</script>';
            }
        } else {
            foreach($errors as $error){
                echo $error . "<br>";
            }
        }
    }
  ?>
</head>
<body>
    <form method="post">
        <div action="supplies.php" class="add-supplier-form" >  
            <label>Name</label>  
            <input type="text" name="Sname" required placeholder="enter your Name">
            <lable>Phone</lable>
            <input type="text" name="Sphone" required placeholder="enter your phone">
            <lable>Email</lable>
            <input type="text" name="Semail" required placeholder="enter your email">
            <lable>Address</lable>
            <input type="text" name="Saddress" required placeholder="enter your address">
            <input type="submit" name="submit" value="Submit" class="form-btn">
        </div>
    </form>
</body>
</html>