<?php
include('connection.php');
$id = $_GET['delete_id'];

$sql = "DELETE FROM customers WHERE customer_id = '$id'";

$query = mysqli_query($conn, $sql);

if($query){
    echo "Deleted successfully!";
    header('location: customers.php');
} else {
    echo "Some error occured!";
}