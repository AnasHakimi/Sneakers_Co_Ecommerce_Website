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

   // Connect to the database
   $host = "localhost";
   $username = "root";
   $password = "";
   $dbname = "webiste";
   
   $conn = new mysqli($host, $username, $password, $dbname);

   $username = $_SESSION['username'];
   $orderID = getOrderID($conn, $username);


   // Retrieve the orders details from the database
   $sql = "SELECT * FROM orders WHERE orderID = $orderID";
   $result = mysqli_query($conn, $sql);
   $orders = mysqli_fetch_assoc($result);

 

?>

<!DOCTYPE html>
<html>
<head>
<title>SNEAKER.CO</title>
<link href="css/receipt.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
</head>
<body>
<div class="main">
  <div class="topnav">
                <div class="logo">
                <a href="index.php"><img src="images/logohome.png" alt="logo"></a>
                </div>
                <div class="wrap">
                <form method="POST" action="search.php">
                    <div class="search">
                       <input type="text" class="searchTerm" name="query"placeholder="What are you looking for?">
                       <button type="submit" class="searchButton">
                         <i class="fa fa-search"></i>
                      </button>
                    </div>
                    </form>
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
<div class="paymentstatus">
<p>Status: <?php echo $orders['payment_status']; ?></p>
</div>
<div class="orderID">
<p>Order ID: <?php echo $orders['orderID']; ?></p>
</div>
<div class="paymentmethod">
<p>Method: <?php echo $orders['payment_method']; ?></p>
</div>
<div class="totalprice">
<p>Total: RM<?php echo $orders['total_price']; ?></p>
</div>
<div class="address">
<p>Shipping Address: <?php echo $orders['shipping_address']; ?></p>
</div>
</div>
<div class="footer">
              <p>&copy 2023 Sneakers.co. All Rights Reserved</p>
</div>

           

            </div>
            
           
</body>
</html>