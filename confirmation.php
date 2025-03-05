<?php
session_start();

function getOrderID($conn, $username) {
  $stmt = mysqli_prepare($conn, "SELECT orderID FROM orders WHERE username = ? ORDER BY orderID DESC");
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $orderID);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);
  return $orderID;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the selected value from the form
    $status = $_POST['status'];


    // Connect to database
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webiste";

    $conn = mysqli_connect($hostname, $username, $password, $dbname);


    // Check if payment was successful
    if ($status == 'Pay') {
      
        $username = $_SESSION['username'];
        $orderID = getOrderID($conn, $username);
        
        // Update order status in database

        $sql = "UPDATE orders, payment, purchase SET orders.payment_status='successful', payment.payment_status='successful', purchase.payment_status='successful' 
        WHERE orders.orderID='$orderID' 
        AND payment.paymentID='$orderID' AND purchase.payment_status=''";
         mysqli_query($conn, $sql);

        // Display success message and redirect to index page
        echo '<script>alert("Payment successful!!"); window.location = "receipt.php";</script>';
    } else {
        $username = $_SESSION['username'];
        $orderID = getOrderID($conn, $username);

        $sql = "UPDATE orders, payment, purchase SET orders.payment_status='unsuccessful', payment.payment_status='unsuccessful', purchase.payment_status='unsuccessful' 
        WHERE orders.orderID='$orderID' 
        AND payment.paymentID='$orderID' AND purchase.payment_status=''";

        mysqli_query($conn, $sql);
        // Display error message and redirect to index page
        echo '<script>alert("Payment failed. Please try again."); window.location = "receipt.php";</script>';
    }
}  
?>

<!DOCTYPE html>
<html>
<head>
<title>SNEAKER.CO</title>
<link href="css/confirmation.css" rel="stylesheet" type="text/css"/>
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
           <form action="" method="post">
           <label for="payment">Please Choose:</label><br>
           <select name="status" id="status">
           <option value=""></option>
           <option value="Pay">Pay ?</option>
           <option value="Not_pay">Not pay</option>
           </select><br><br>
           <input type="submit" id="payment-button" value="Payment" name="submit">
           </form>
            </div>
            <div class="cont2">
            <img style="display:none" class="pic" src="images/valid.png">
            <img style="display:none" class="pic2" src="images/failed.png">
            </div>
          </div>
          <div class="footer">
<p>&copy 2023 Sneakers.co. All Rights Reserved</p>
</div>
</div>

</body>
</html>

