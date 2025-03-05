<!DOCTYPE html>
<html>
<head>
<title>MY CART</title>
<link href="css/cart.css" rel="stylesheet" type="text/css"/>
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
     <div class="cartcontainer">
     <div class="texthead">
     <h1>My Cart.</h1>
     </div>
     <div class="cartitem">
     

     <div class="productdisplay">
<?php
session_start();


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

// Connect to the database
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "webiste";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION) && !empty($_SESSION)) {
  // Get the username from the session
  $username = $_SESSION['username'];

  // Query the database
  $sql = "SELECT * FROM cart WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {
      // Output the data
      while ($row = mysqli_fetch_assoc($result)) {
  

          $productID = $row["productID"];
          $sql = "SELECT product_img FROM product WHERE productID = $productID";
          $imageResult = mysqli_query($conn, $sql);
          if (mysqli_num_rows($imageResult) > 0) {
              
              $imageRow = mysqli_fetch_assoc($imageResult);
              $imageURL = $imageRow["product_img"];
              
          }
         
          $price = $row["product_price"];
          $size = $row["size_name"];
          $quantity = $row["quantity"];

          echo " <table>";
          // Output the image
          echo " <td><img src=$imageURL></td>";
            // Output price
          echo " <td><b>Price: RM$price </b><br>";
          echo " $size";
          // Add a update button
          echo " <br>Quantity: <form class='update-form'action='cartquantity.php' method='post'>";
          echo " <input class='update-number' type='number' name='quantity'  value='$quantity'>";
          echo " <input type='hidden' name='productID' value='$productID'>";
          echo " <input type='hidden' name='size_name' value='$size'>";
          echo " <input class='update-button' type='submit' value='Update'>";
          echo " </form><br>";
          // Add a delete button
          echo " <form action='deleteitem.php' method='post'>";
          echo " <input type='hidden' name='productID' value='$productID'>";
          echo " <input type='hidden' name='size_name' value='$size'>";
          echo " <input class='delete-button' type='submit' value='Remove'>";
          echo " </form>";
          echo " </td>";
          echo " </table><br>";
  
      }
      ?>
      </div>
      <div class="summary">
      <h1>Summary.</h1>
      <?php

      $totalPrice = calculateTotalPrice($conn, $username);
      echo "<h2>Total : RM$totalPrice</h2>";

      echo "<form action='checkout.php' method='post'>
      <input type='hidden' name='productID' value='$productID'>
      <input class='checkout-button' type='submit' value='Checkout'>
      </form>";
      ?>
      </div>
     
       
      <?php
  }
      else {
          echo "No items found in cart";
     }
}
     
    else{
    // User is not logged in, redirect them to the login page
    echo '<script>alert("You are not logged in!"); window.location = "login.html";</script>';
     }

   

mysqli_close($conn);

?>
</div>
    </div>
</div>
<?php

require_once 'connection.php';

$sql = "SELECT * FROM product";
$all_product = $conn->query($sql);

?>
<br>
<br>
<br>
<div class="suggestion">
  <div class="suggesthead">
    <h4>- You May Also Like -</h4>
  </div>
  <div class="item">
  <?php
    // Get the number of rows in the result set
    $num_rows = mysqli_num_rows($all_product);

    // Create an array to store the rows that have already been displayed
    $displayed_rows = array();

    // Initialize a counter to keep track of the number of products displayed
    $products_displayed = 0;

    // Loop until five products have been displayed
    while ($products_displayed < 5) {
      // Generate a random number within the range of the number of rows
      $random_row = rand(0, $num_rows - 1);

      // If the random row has already been displayed, skip this iteration
      if (in_array($random_row, $displayed_rows)) {
        continue;
      }

      // Seek to the random row in the result set
      mysqli_data_seek($all_product, $random_row);

      // Fetch the row at the current cursor position
      $row = mysqli_fetch_assoc($all_product);

      // Add the row to the array of displayed rows
      $displayed_rows[] = $random_row;

      // Increment the counter for the number of products displayed
      $products_displayed++;
  ?>
      <div class="card">
           <a href="/website/product.php?id=<?php echo $row['productID']; ?>">
            <img src="<?php echo $row["product_img"]; ?>" alt="<?php echo $row["product_name"]; ?>" style="width:100%">
            </a>
            <a style="text-decoration: none;" href="/website/product.php?id=<?php echo $row['productID']; ?>">
            <p class="nameitem"><?php echo $row["product_name"]; ?></p>
            </a>
            <p class="price">RM<?php echo $row["product_price"]; ?></p>
      </div>
    <?php } ?>
  </div>
</div>
<div class="footer">
<p>&copy 2023 Sneakers.co. All Rights Reserved</p>
</div>

</body>
</html>



