<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/addcustomers.css"/>
  <?php
  include('connection.php');
  if(isset($_POST['submit'])){
      $username = $_POST['Username'];
      $age=$_POST['Uage'];
      $phone=$_POST['Uphone'];
      $address=$_POST['address'];
      $gender=$_POST['gender'];

      // Validate Username
    if(empty($username)){
      $errors[] = "Username is required";
  }

  // Validate Age as numeric and within a reasonable range
  if(!is_numeric($age) || $age <= 0 || $age > 150){
      $errors[] = "Invalid age";
  }

  // Validate Phone number
  if(!preg_match("/^\d{10}$/", $phone)){
      $errors[] = "Invalid phone number format (10 digits)";
  }

  // Validate Address
  if(empty($address)){
      $errors[] = "Address is required";
  }

  // Validate Gender (assuming gender is selected from a predefined set of values)
  $allowedGenders = array("Male", "Female", "Other");
  if(!in_array($gender, $allowedGenders)){
      $errors[] = "Invalid gender";
  }
  //js for alert msg
if(empty($errors)){
        $query="INSERT INTO customers (name, age, phone, address, sex) values ('$username', '$age', '$phone', '$address', '$gender')";

        $query_run=mysqli_query($conn,$query);

        if($query_run){
            echo '<script>alert("Data is inserted successfully");</script>';
            header("Location: customers.php");
        } else {
            echo '<script>alert("Data is not inserted successfully");</script>';
        }
    } else {
        foreach($errors as $error) {
            echo $error . '<br>';
        }
    }

}

?>





</head>
<body>
    
<form method="post">
<div class="add-customer-form" >    
<input type="text" name="Username" required placeholder="enter your Name" >
<input type="text" name="Uage" required placeholder="enter your age">
<input type="text" name="Uphone" required placeholder="enter your Phone">
<input type="text" name="address" required placeholder="enter your address">
<label>Gender</label>
<input type="radio" name="gender" value="Male">Male
<input type="radio" name="gender" value="Female">Female
<input type="radio" name="gender" value="Other">other
    <input type="submit" name="submit" value="login now" class="form-btn">
</form>
</div> 
</body>
</html>