<?php
include('connection.php');
$id = $_GET['delete_id'];

$sql = "DELETE FROM medicine WHERE id = '$id'";

$query = mysqli_query($conn, $sql);

if($query){
    echo "Deleted successfully!";
    header('location: drugs.php');
} else {
    echo "Some error occured!";
}