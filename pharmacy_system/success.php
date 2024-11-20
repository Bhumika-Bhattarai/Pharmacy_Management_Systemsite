<?php
include('./users/php/connection.php');
$data = $_GET['data'];

$dec = base64_decode($data);
$json = json_decode($dec, true);

$date = date('Y-m-d');
$sql = "INSERT INTO payment (drug, amount, date) VALUES ('$json[product_code]', '$json[total_amount]', '$date')";
$query = mysqli_query($conn, $sql);

if ($query) {
    header("location: ./users/php/home.php");
}

?>