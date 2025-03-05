<!DOCTYPE html>
<html>
<head>
<title>SNEAKER.CO</title>
<link href="css/search.css" rel="stylesheet" type="text/css"/>
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
     <div class="nav2">
                <ul>
                    <li><a href="men.php">Men</a>
                    </li>
                        <li><a href="women.php">Women</a>
                    </li>
                        <li><a href="kids.php">Kids</a>
                    </li> 
                </ul>
            </div>
            <div class="headtop">
            <img src="images/mainsection.png" alt="imagesmid" style="width:60%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);">
            </div><br><br>
            <div class="productshow">
              <div class="headtext">
            <h2 style="text-align:left">This is what you looking for?</h2>
          </div>
     <div class="carditem">
<?php
// search.php

// Get the search query from the form
$query = $_POST['query'];

// Connect to the database
$db = new mysqli('localhost', 'root', '', 'webiste');

// Query the database
$result = $db->query("SELECT * FROM product WHERE product_name LIKE '%$query%'");

// Display the results in an HTML table

if ($result->num_rows == 0) {
    // No results were found, so display an alert message
    echo '<script>alert("Sorry, your item was not found."); window.location = "index.php";</script>';
    
  } else {
    while ($row = $result->fetch_assoc()) {
      echo '<div class="card">';
      echo '  <a href="/website/product.php?id=' . $row['productID'] . '">';
      echo '  <img src="' . $row["product_img"] . '" alt="' . $row["product_name"] . '" style="width:100%">';
      echo '  </a>';
      echo '  <a style="text-decoration: none;" href="/website/product.php?id=' . $row['productID'] . '">';
      echo '  <p class="nameitem">' . $row["product_name"] . '</p>';
      echo '  </a>';
      echo '  <p class="price">RM' . $row["product_price"] . '</p>';
      echo '  </div>';
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



  






  