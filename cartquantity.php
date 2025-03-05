<?php

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'webiste');

// Check if the form has been submitted
if (isset($_POST['productID']) && isset($_POST['quantity']) && isset($_POST['size_name'])) {
    // Get the product ID, quantity and size from the form
    $productID = mysqli_real_escape_string($conn, $_POST['productID']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $size = mysqli_real_escape_string($conn, $_POST['size_name']);

    // Update the quantity and size in the database
    $sql = "UPDATE cart SET quantity = $quantity WHERE productID = $productID AND size_name = '$size'";
    mysqli_query($conn, $sql);

    // Redirect the user back to the shopping cart page
    echo '<script>alert("Successfully update card !"); window.location = "seecart.php";</script>';
    exit;
}

?>

