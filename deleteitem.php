<?php
session_start();


// Connect to the database
require_once 'connection.php';

if (isset($_POST['productID'])) {
    // Get the productID from the form submission
    $productID = $_POST['productID'];

    $size = $_POST['size_name'];

    // Delete the item from the cart
    $sql = "DELETE FROM cart WHERE size_name = '$size' AND productID = $productID";
    mysqli_query($conn, $sql);

    // Redirect the user back to the cart page
    header('Location: seecart.php');
}
