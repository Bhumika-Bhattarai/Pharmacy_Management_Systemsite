<!DOCTYPE html>
<html>
<head>
    <title>User Panel</title>
    <link rel="stylesheet" href="../css/home.css"/>
    <style>
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
        .btn-info {
            background-color: #17a2b8;
        }
        .btn-out-of-stock {
            background-color: red;
        }
        .col-4 {
            width: calc(33.33% - 20px);
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow effect */
        }
        .col-4:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Change shadow on hover */
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <img src="../images/logo1.png" height="100" width="150">
        </div>
        <nav>
            <ul>
                <input type="text">
                <button>Search</button>
                <li><a href="all_cart.php"><img src="../images/cart4.png" height="25px" width="25px"></a></li>
            </ul>
        </nav>
    </div>

    <div class="container">
        <div class="modal">
            <div class="row1">
                <div class="col_3">
                    <h1>Your Health <br> Our Care...</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="newarrival">
        <div class="row">
            <div class="subheading"></div>
        </div>
    </div>

    <?php
    include('connection.php');

    // Fetch data from the database
    $query = "SELECT * FROM medicine";
    $result = mysqli_query($conn, $query);
    ?>

    <div class="container">
        <div class="row">
            <?php
            // Loop through the fetched data and display items
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-4">';
                echo '<img src="../images/' . $row['image'] . '" height="300px" width="300px">';
                echo '<span class="currency">' . $row['name'] . '<br>';
                echo 'Supplier: ' . $row['supplier'] . '<br>';
                echo 'Price: Rs ' . $row['price'] . '<br>';
                echo 'Ex. Date (mm/yy): ' . $row['expirydate'] . '<br>';
                echo 'Mf. Date (mm/yy): ' . $row['mfg_date'] . '<br>';
                if ($row['quantity'] > 0) {
                    echo '<a href="cart.php?p_id=' . $row['id'] . '" class="btn btn-info">Add to cart</a></span>';
                } else {
                    echo '<span class="btn btn-out-of-stock">Out of Stock</span>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>


 	<!-- footer	 -->
 	<!-- <div class="footer">
 		<div class="container">
 			<div class="row">
 				<div class="footer-col-1">
 					<h3>Download Our App</h3>
 					<p1>Download app for ios and android mobile phone</p1><br>
 					<img src="../webimage/appstore.jpg" height="50px" width="100">
 					<img src="../webimage/playstore.png" height="50px" width="100">
 					
 				</div>
 				
 				<div class="footer-col-4">
 					<h3>Follow Us</h3>
 					<ul>
 						<li>Facebook:@generousglam</li>
 						<li>Instagram:@generousglam</li>
 						<li>Twitter:@generousglam</li>
 						<li>YouTube:@generousglam</li>
 						
 					</ul>
 				</div>
 				<div class="footer-col-2">
 					<img src="../images/logo1.png" height="100" width="150"><br>
					All rights reserved copyright- Designed by Bhumika
                </div>
 			</div>
 		</div>
 	</div> -->

</body>
</html>




