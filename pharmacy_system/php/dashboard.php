<?php

include('connection.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to count the number of rows in a table
$sql = "SELECT COUNT(*) as total_rows FROM payment";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the result
    $row = $result->fetch_assoc();
    // Print the total number of rows
    
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>

<span style="font-family: verdana, geneva, sans-serif;"><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="../css/dashboard.css"/>
  <!-- Font Awesome Cdn Link for icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>
<div class="logos">
           <img src="../images/logo1.png" height="100" width="200" >
           <!-- <input type="search" id="site-search" name="q" />
           <button>Search</button> -->

</div>


  <div class="container">
    <nav>
      <ul>
        <li><a href="#" class="logo">
        <b> Admin </b>
          <div><img src="../images/prof.jpg"></div>
        </a></li>
          <span class="nav-item">Patients</span>
        <li><a href="addcustomers.php">
          <i class="fas fa-wallet"></i>
          <span class="nav-item">Add Customers</span>
        </a></li>
        <li><a href="customers.php">
          <i class="fas fa-user"></i>
          <span class="nav-item">Customers</span>
        </a></li>
          <span class="nav-item">Pharmacy</span>
        <li><a href="adddrugs.php">
          <i class="fas fa-tasks"></i>
          <span class="nav-item">Add Drugs</span>
        </a></li>
        <li><a href="drugs.php">
          <i class="fas fa-capsules"></i>
          <span class="nav-item">Drugs</span>
        </a></li>
       
        <li><a href="AddSupplier.php">
          <i class="fas fa-laptop-code"></i>
          <span class="nav-item">Add Suppliers</span>
        </a></li>
        <li><a href="supplies.php">
          <i class="fas fa-clone"></i>
          <span class="nav-item">Suppliers</span>
        </a></li>
        </a></li>
          <span class="nav-item">User Panel</span>
        <li><a href="../users/php/userlogin.php">
          <i class="fas fa-wallet"></i>
          <span class="nav-item">Display Items</span>
        </a></li>
       
        <li><a href="logout.php" class="logout" onclick = "myFunction()">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Log out</span>

          <!-- java script for alert message -->
          <script>
        function myFunction() {
        alert("Are you sure you want to logout!")
        }
      </script>
        </a></li>
      </ul>
    </nav>

    <section class="main">
      <div class="main-top">
        <h1>DASHBOARD</h1>
        <!-- <i class="fas fa-user-cog"></i> -->
      </div>
      <div class="main-skills">
        <div class="card">
          <i class="fas fa-wallet"></i>
          <h3>In Stock Medicine</h3>
          <a href="drugs.php">
          <button>Get Started</button>
          </a>
        </div>
        <div class="card">
          <i class="fas fa-portrait"></i>
          <h3>Out of Stock Medicine</h3>
          <p>2</p>
          <button>Get Started</button>
        </div>
        <div class="card">
          <i class="fas fa-laptop-code"></i>
          <h3> Total sales Item</h3>
          <p><?php echo $row['total_rows']; ?></p>
          <a href="payment.php">
          <button>Get Started</button>
         </a>
        </div>
        <div class="card">
          <i class="fas fa-capsules"></i>
          <h3>Total Sale</h3>
          <a href="totalpayment.php">
          <button>Get Started</button>
          </a>
        </div>
      </div>

      <section class="main-course">
        <!-- <h1>New Items</h1> -->

        <div class="course-box">
          <img src="../images/green.jpg" heigh height="400" width="1200">
         
        </div>
      </section>
    </section>
  </div>
</body>
</html>