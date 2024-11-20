<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier List</title>
    <link rel="stylesheet" href="../css/supplies.css"/>
    <style>
        .edit-btn {
    color: white;
    background-color: green;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 5px;
}

.delete-btn {
    color: white;
    background-color: red;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 5px;
}

    </style>
</head>
<body>

<div class="row">

    <div class="col-md-12 form-group form-inline">
        <form method="post">
            <label class="font-weight-bold" for="">Search :&emsp;</label>
            <input type="text" class="form-control" name="search" placeholder="Search Supplier">
            <input type="submit" value="Search" class="btn btn-primary">
        </form>
    </div>

    <div class="col col-md-12">
        <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
    </div>

    <div class="col col-md-12 table-responsive">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 5%;">SL</th>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 15%;">Email</th>
                        <th style="width: 15%;">Contact Number</th>
                        <th style="width: 20%;">Address</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the connection file
                    include('connection.php');

                    // Handling Search operation
                    if (isset($_POST['search'])) {
                        $search_query = $_POST['search'];
                        $sql = "SELECT * FROM supplier WHERE Sname LIKE '%$search_query%' OR Semail LIKE '%$search_query%' OR Saddress LIKE '%$search_query%'";
                    } else {
                        $sql = "SELECT * FROM supplier";
                    }

                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $row['supplier_id'] . '</td>';
                            echo '<td>' . $row['Sname'] . '</td>';
                            echo '<td>' . $row['Semail'] . '</td>';
                            echo '<td>' . $row['Sphone'] . '</td>';
                            echo '<td>' . $row['Saddress'] . '</td>';
                            echo "<td>";
                            echo "<a href='editsupplier.php?edit_id=" . $row['supplier_id'] . "' class='edit-btn'>Edit</a> &nbsp;";
                            echo "<a href='deletesupplier.php?delete_id=" . $row['supplier_id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this supplier?\")'>Delete</a>";
                            echo "</td>";
                            echo '</tr>';
                            $count++;
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
