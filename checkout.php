<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "webiste";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function calculateTotalPrice($conn, $username) {
    // Query the database
    $sql = "SELECT * FROM cart WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
  
    $totalPrice = 0;
    if (mysqli_num_rows($result) > 0) {
      // Process each row
      while ($row = mysqli_fetch_assoc($result)) {
        $totalPrice += $row["product_price"]*$row["quantity"];
      }
    }
  
    return $totalPrice;
  }

  function calculateTotalQuantity($conn, $username) {
    // Query the database
    $sql = "SELECT * FROM cart WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
  
    $totalQuantity = 0;
    if (mysqli_num_rows($result) > 0) {
      // Process each row
      while ($row = mysqli_fetch_assoc($result)) {
        $totalQuantity += $row["quantity"];
      }
    }
  
    return $totalQuantity;
 }

  ?>
  
  <script type="text/javascript">
  function displayImage() {
    var image = document.getElementsByClassName("pic")[0];
    image.style.display = "block";
    document.getElementsByClassName("input-update")[0].disabled = true;
    setTimeout(function() {
      window.location.href = "confirmation.php";
    }, 3000);
  }
  </script>
<!DOCTYPE html>
<html>
<head>
<title>SNEAKER.CO</title>
<link href="css/checkout.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
</head>
<body>
<div class="main">
  <div class="topnav">
                <div class="logo">
                <a href="index.php"><img src="images/logohome.png" alt="logo"></a>
                </div>
                <div class="nav">
                <ul>
                    <li><a href="browse.php">Browse</a>
                    </li>
                        <li><a href="about.php">About</a>
                    </li>
                    <li><a href="seecart.php">Cart</a>
                    </li>
                        <li><a href="login.html">Log In</a>
                    </li> 
                </ul>
                <div class="dropdown">
             <button class="dropbtn"><i class="fa fa-bars"></i></button>
              <div class="dropdown-content">
                <a href="logout.php">Log Out</a>
                  </div>
            </div>
            </div>
            </div>
            <div class="container">
            <div class="cont1">
            <div class="displaytotal">
             <?php
                // Display the total price
                $username = $_SESSION['username'];
                $total_price = calculateTotalPrice($conn, $username);
                echo "<h2>Total Price: RM$total_price</h2><br>";
               ?>
            </div>
            <div class="formcheckout">
              <!-- Display the checkout form -->
               <form action="checkout.php" method="post">
               <label for="address">Shipping address:</label><br>
               <input class="form-update" type="text" name="address" id="address"><br>
               <label for="payment_method">Payment method:</label><br>
               <select class="select-update" name="payment_method" id="payment_method">
               <option value=""></option>
               <option value="cash">Cash</option>
               <option value="Online Banking">Online Banking</option>
               </select><br><br>
               <input class="input-update" type="submit" value="Place order" name="submit">
               </form>
            </div>
            </div>
            <div class="cont2">
            <img style="display:none" class="pic" src="images/checkouticon.png">
            <?php 
                     if (isset($_POST['submit'])) {
                      // Get the form data
                      $address = $_POST['address'];
                      $payment_method = $_POST['payment_method'];
                    
                      // Validate the form data
                      if (empty($address)) {
                        $error = "Please enter a valid shipping address";
                      } elseif (empty($payment_method)) {
                        $error = "Please select a payment method";
                      } else {
                        // Insert the order into the database
                        $username = $_SESSION['username'];
                        $total_quantity = calculateTotalQuantity($conn, $username);
                        $total_price = calculateTotalPrice($conn, $username);
                        $sql = "INSERT INTO payment (username, product_quantity, total_price, payment_method)
                          VALUES ('$username', '$total_quantity', '$total_price', '$payment_method')";
                        mysqli_query($conn, $sql);
                        
                        $sql5 = "START TRANSACTION";
                        $sql6 = "INSERT INTO orders (orderID, username, product_quantity, total_price, payment_method, payment_status) 
                                  SELECT paymentID, username, product_quantity, total_price, payment_method, payment_status FROM payment 
                                  WHERE username = '$username' AND payment_status = ''";
                        $sql7 = "UPDATE orders SET shipping_address='$address' WHERE username='$username' AND shipping_address =''";
                        $sql8 = "COMMIT";

                         mysqli_query($conn, $sql5);
                         mysqli_query($conn, $sql6);
                         mysqli_query($conn, $sql7);
                         mysqli_query($conn, $sql8);
                         
                        // Add data to table purchase and Clear the cart
                        $sql1 = "START TRANSACTION";
                        $sql2 = "INSERT INTO purchase (purchaseID, productID, product_price, quantity, username, variation_id, size_name) 
                        SELECT cartID, productID, product_price, quantity, username, variation_id, size_name FROM cart WHERE username = '$username'";
                        $sql3 = "DELETE FROM cart WHERE username = '$username'";
                        $sql4 = "COMMIT";

                         mysqli_query($conn, $sql1);
                         mysqli_query($conn, $sql2);
                         mysqli_query($conn, $sql3);
                         mysqli_query($conn, $sql4);

                        
                        // Display image and redirect to confirmation page
                        echo '<script>';
                        echo 'displayImage();';
                        echo '</script>';
                      }
                    }
            ?>
            </div>
            </div> 
            <div class="footer">
            <p>&copy 2023 Sneakers.co. All Rights Reserved</p>
           </div>
     </div>
 
  </body>
  </html>

