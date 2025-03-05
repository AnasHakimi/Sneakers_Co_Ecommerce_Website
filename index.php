<?php
session_start();

require_once 'connection.php';

$sql = "SELECT * FROM product";
$all_product = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <title>Welcome</title>
        <link href="css/homestyle.css" rel="stylesheet" type="text/css"/>
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
                    <li><a href="browse.php">Browse</a></li>
                    <li><a href="about.php">About</a> </li>
                    <li><a href="seecart.php">Cart</a></li>
                    <li><a href="login.html">Log In</a></li> 
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
            </div>
            <br>
            <h2 style="text-align:center">Recommended For You</h2>
            
            
            <div class="product">
                <?php
                for ($i = 0; $i < 6; $i++) {
                $row = mysqli_fetch_assoc($all_product);
                 if ($row) {
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
                <?php
                   } else {
                    break;
                }
                 }
                ?>
               </div>
               <br>
               <br>

               
               <a class="headmid" href="product.php?id=13"><img src="images/midsection.png" alt="imagesmid" style="width:60%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);"></a>
               <br>
               
               <h2 style="text-align:center">Trending</h2>
               

               <div class="product2">
               <?php
                for ($i = 0; $i < 6; $i++) {
                $row = mysqli_fetch_assoc($all_product);
                 if ($row) {
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
                <?php
                   } else {
                    break;
                }
                 }
                ?>
               </div>
               <div class="footer">
<p>&copy 2023 Sneakers.co. All Rights Reserved</p>
</div>
        </div>
    </body>
 
</html>