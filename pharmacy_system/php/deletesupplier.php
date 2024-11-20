<?php
include('connection.php');
$id = $_GET['delete_id'];

$sql = "DELETE FROM supplier WHERE supplier_id = '$id'";

$query = mysqli_query($conn, $sql);

if($query){
    echo "Deleted successfully!";
    header('location: supplies.php');
} else {
    echo "Some error occured!";
}