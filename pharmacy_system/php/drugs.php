<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Table</title>
    <link rel="stylesheet" href="../css/drugs.css"/>
    <style>
        .expired {
            color: red;
        }
        .btn {
            padding: 8px 16px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            margin-right: 5px;
        }
        .btn-edit {
            background-color: green;
        }
        .btn-delete {
            background-color: red;
        }
    </style>
</head>

<body>
    <?php
    include('connection.php');
        
    // Handling Search operation
    if(isset($_POST['search'])) {
        $search_query = $_POST['search'];
        $sql = "SELECT * FROM medicine WHERE name LIKE '%$search_query%' OR phone LIKE '%$search_query%' OR address LIKE '%$search_query%'";
    } else {
        $sql = "SELECT * FROM medicine";
    }

    $result = mysqli_query($conn, $sql);
    ?>

    <!-- Your HTML table structure -->
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th style="width: 1%;">SN.</th>
                <th style="width: 1%;">ID</th>
                <th style="width: 14%;">Medicine Name</th>
                <th style="width: 5%;">Image</th>
                <th style="width: 10%;">Supplier</th>
                <th style="width: 8%;">Price</th>
                <th style="width: 15%;">Mf. Date (mm/yy)</th>
                <th style="width: 7%;">Ex. Date (mm/yy)</th>
                <th style="width:5%;">MG</th>
                <th style="width: 5%;">Quantity</th>
                <th style="width: 10%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $counter = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                // Check if the medicine is expired
                $isExpired = strtotime($row['expirydate']) < time();
                
                echo "<tr>";
                echo "<td>" . $counter++ . "</td>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td><img src='../images/" . $row['image'] . "' alt='Medicine Image' style='width: 50px; height: 50px;'></td>";
                echo "<td>" . $row['supplier'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['mfg_date'] . "</td>";
                echo "<td class='" . ($isExpired ? "expired" : "") . "'>" . $row['expirydate'] . "</td>";
                echo "<td>".$row['mg']."</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>";
                echo "<a href='editdrugs.php?edit_id=" . $row['id'] . "' class='btn btn-edit'>Edit</a>&nbsp;";
                echo "<a href='deletedrugs.php?delete_id=" . $row['id'] . "' class='btn btn-delete' onclick='return confirm(\"Are you sure you want to delete this medicine?\")'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
