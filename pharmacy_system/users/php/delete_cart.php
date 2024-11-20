<?php
session_start(); // Start the session

$name = $_GET['name'];

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

function removeFromCart($name) {
    global $cart;

    if (!empty($cart)) {
        // Loop through the cart and find the item with the matching name
        foreach ($cart as $key => $item) {
            if ($item['name'] === $name) {
                // Remove the item from the cart
                unset($cart[$key]);
                // Re-index the array to maintain proper keys
                $cart = array_values($cart);
                break; // Exit the loop once the item is found and removed
            }
        }
    }
}

removeFromCart($name);

// Update the session with the modified cart
$_SESSION['cart'] = $cart;

header("location: all_cart.php");
?>
