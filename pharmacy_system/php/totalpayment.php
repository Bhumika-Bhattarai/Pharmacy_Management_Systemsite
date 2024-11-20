<?php
include('connection.php');

// Handle the delete action
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    
    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM payment WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    
    if ($stmt->execute()) {
        // Deletion successful, redirect to the display page
        header("Location: totalpayment.php");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch all data from the 'payment' table
$sql = "SELECT * FROM payment";
$query = mysqli_query($conn, $sql);

// Initialize total amount
$total_amount = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Records</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .delete-btn {
            color: red;
            text-decoration: none;
        }
        .delete-btn:hover {
            text-decoration: underline;
        }
        .total {
            font-weight: bold;
            margin-top: 10px;
        }
        .total-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            width: 200px;
            margin: 10px auto;
        }
        .total-btn:hover {
            background-color: #d32f2f;
        }
        .total-field{
            font-size:1.5rem; 
            background-color: #f44336;
            text-align:center;
            width:220px;
            border-radius:10px;
        }
    </style>
</head>
<body>
    <h1>Payment Records</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Drug</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php
        if ($query && mysqli_num_rows($query) > 0) {
            // Display fetched data
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['drug']) . "</td>";
                echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
                echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                echo "<td><a class='delete-btn' href='totalpayment.php?delete_id=" . htmlspecialchars($row['id']) . "' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a></td>";
                echo "</tr>";
                
                        // Calculate total amount
                $total_amount += $row['amount'];                
            }

            } else {
            echo "<tr><td colspan='5'>No records found</td></tr>";
        }
        ?>
    </table>
    
    <?php if (mysqli_num_rows($query) > 0): ?>
    <div class="total">
        <p class='total-field'>Total Amount: <?php echo $total_amount ?></p>
    </div>
    <?php endif; ?>
<script>
    const refresh = document.querySelector('.total-btn');
    refresh.addEventListener('click',()=>{
        window.location.reload();
    })
</script>
</body>
</html>
