<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form>

                    <label for="new_name">Name:</label>
                    <input type="text" name="new_name"  required>

                    <label for="new_phone">Phone:</label>
                    <input type="text" name="new_phone"  required>

                    <label for="new_age">Age:</label>
                    <input type="text" name="new_age" required>


                    <label for="new_address">Address:</label>
                    <input type="text" name="new_address"  required>

                    <label>Gender</label>
                    <input type="radio" name="sex" value="male">Male
                    <input type="radio" name="sex" value="Female">Female
                    <input type="radio" name="sex" value="other">other
                    
                    



                    <input type="submit" name="submit">
    </form>
</body>
</html>

<?php


if(isset($_GET['submit']))
    $name= $_GET['new_name'];
    $phone= $_GET['new_phone'];
    $age= $_GET['new_age'];
    $address= $_GET['new_address'];
    $gender= $_GET['sex'];

    if(mysqli_fetch_assoc())






?>


