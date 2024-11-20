<?php
session_start(); // Start or resume a session
include('connection.php');
$id = $_GET['p_id'];
echo $id;
// exit;

// Check if the product ID is provided in the URL
if ($id) {
    $productId = $_GET['p_id'];

    // Check if the product ID is valid (you may want to validate against your database)
    $productDetails = getProductDetails($productId);

    if ($productDetails) {
        // Add the product to the cart
        addToCart($productId, $productDetails);

        // Redirect back to the product listing with a success message
        header("Location: home.php?success=1");
        exit();
    } else {
        // Redirect with an error message if the product ID is not valid
        header("Location: home.php?error=2");
        exit();
    }
} else {
    // Redirect to a default page or show an error message if no product ID is provided
    header("Location: home.php?error=1");
    exit();
}

// Function to add the product to the cart
function addToCart($productId, $productDetails) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product is already in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }
    
    // If not found, add it as a new item
    if (!$found) {
        $_SESSION['cart'][] = array(
            'id' => $productId,
            'name' => $productDetails['name'],
            'price' => $productDetails['price'],
            'quantity' => 1, // Set initial quantity to 1
            // Add any other relevant product details here
        );
    }
}

// Function to retrieve product details from the database
function getProductDetails($productId) {
    include('connection.php');
    $sql = "SELECT * FROM medicine WHERE id = '$productId'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        return $row; // Return product details
    } else {
        return null; // Product not found
    }
}
?>
