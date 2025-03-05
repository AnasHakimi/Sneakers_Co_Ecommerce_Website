<?php
session_start();


// Check if the user is logged in
if (isset($_SESSION) && !empty($_SESSION)) {

   
    // User is logged in, add the product to the cart
    if ( $product_id = $_GET['id']) {

        
        // Connect to the database
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "webiste";
        $conn = new mysqli($host, $username, $password, $dbname);


        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
       
        $productID = mysqli_real_escape_string($conn, $_GET['id']);
        $username = mysqli_real_escape_string($conn, $_SESSION['username']);
        $quantity = '1';
        $size = $_POST['size'];



         // Get the size_id from the sizeProduct table
    $sizeIDQuery = "SELECT size_id FROM sizeproduct WHERE size_name = '$size'";
    $result = $conn->query($sizeIDQuery);
    $sizeID = null;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sizeID = $row['size_id'];
    }

    // Get the variation_id of the product from the variation table
    $variationIDQuery = "SELECT variation_id FROM variation WHERE productID = '$productID' AND size_id ='$sizeID' ";
    $result = $conn->query($variationIDQuery);
    $variationID = null;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $variationID = $row['variation_id'];
    }




// Get the price of the product from the product table
        $productPriceQuery = "SELECT product_price FROM product WHERE productID = '$productID'";
        $result = $conn->query($productPriceQuery);
        $productPrice = null;
        if ($result->num_rows > 0) {
           $row = $result->fetch_assoc();
           $productPrice = $row['product_price'];
        }



    // If the item is not in the purchase with this size, add a new row
    $query = "INSERT INTO purchase (productID, username, quantity, product_price, variation_id, size_name) VALUES ('$productID', '$username','$quantity', '$productPrice', '$variationID', '$size')";
    if ($conn->query($query) === TRUE) {
        echo '<script>window.location = "buynow.php";</script>';
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
 


  
   $conn->close();

} else {
       
        echo '<script>alert("Error: Product ID was not provided."); </script>';
        
    }
} else {
    
    echo '<script>alert("You are not logged in!"); window.location = "login.html";</script>';
   
    exit;
}
?>
