
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Table</title>
    <link rel="stylesheet" href="../css/customers.css" />

    
</head>
<body>
    <?php 
        include('connection.php');
        
       
        
        // Handling Search operation
        if(isset($_POST['search'])) {
            $search_query = $_POST['search'];
            $sql = "SELECT * FROM customers WHERE name LIKE '%$search_query%' OR phone LIKE '%$search_query%' OR address LIKE '%$search_query%'";
        } else {
            $sql = "SELECT * FROM customers";
        }

        $result = mysqli_query($conn, $sql);
    ?>

    <div class="row">
        <div class="col-md-12 form-group form-inline">
            <form method="post">
                <label class="font-weight-bold" for="">Search :&emsp;</label>
                <input type="text" class="form-control" name="search" placeholder="Search Customer">
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
                            <th>SN.</th>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>AGE</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th>Gender</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $counter = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $counter++ . "</td>";
                                echo "<td>" . $row['customer_id'] . "</td>";

                                echo "<td>" . $row['name'] . "</td>";
                                
                                echo "<td>" . $row['age'] . "</td>";

                                echo "<td>" . $row['phone'] . "</td>";
                                
                               

                                echo "<td>" . $row['address'] . "</td>";
                                
                                echo "<td>" . $row['sex'] . "</td>";

                                echo "<td>";
                                echo "<a href='editcustomer.php?edit_id=" . $row['customer_id'] . "' style='background-color: green; color: white; padding: 8px 12px; border-radius: 4px; text-decoration: none;'>Edit</a>&nbsp;";
                                echo "<a href='deletecustomer.php?delete_id=" . $row['customer_id'] . "' style='background-color: red; color: white; padding: 8px 12px; border-radius: 4px; text-decoration: none;' onclick='return confirm(\"Are you sure you want to delete this customer?\")'>Delete</a>";

                                echo "</td>";
                                
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    