<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'webiste');

?>

<!DOCTYPE html>
<html>
<head>
<title>SNEAKER.CO</title>
<link href="css/styleproduct.css" rel="stylesheet" type="text/css"/>
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
            <a class="productbig" href="product.php?id=20"> <img  src="images/kidsection.png" alt="imagesmid" style="width:60%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);"></a>
            </div>
            <br>
            <br>
            <div class="container">
<div class="formfilter">
<h3>Filter</h3>
<form class="form2" method="POST">
  <label>Brand:</label><br>
  <input type="checkbox" name="brand" value="Nike" id="brand_nike">
  <label for="brand_nike">Nike</label><br>
  <input type="checkbox" name="brand" value="Vans" id="brand_vans">
  <label for="brand_vans">Vans</label><br>
  <input type="checkbox" name="brand" value="New Balance" id="brand_new_balance">
  <label for="brand_new_balance">New Balance</label><br>
  <input type="checkbox" name="brand" value="Makerz" id="brand_makerz">
  <label for="brand_makerz">Makerz</label><br>
  <input type="checkbox" name="brand" value="Sniika" id="brand_sniika">
  <label for="brand_sniika">Sniika</label><br>
  <input type="checkbox" name="brand" value="Converse" id="brand_converse">
  <label for="brand_converse">Converse</label><br>
  <input type="checkbox" name="brand" value="Compass" id="brand_compass">
  <label for="brand_compass">Compass</label><br>
  <br>
  <label>Price:</label><br>
  <input type="radio" name="product_price" value="150" id="price_below150">
  <label for="price_below150">Below RM150</label><br>
  <input type="radio" name="product_price" value="250" id="price_below250">
  <label for="price_below250">Below RM250</label><br>
  <input type="radio" name="product_price" value="300" id="price_below300">
  <label for="price_below300">Below RM300</label><br>
  <input type="radio" name="product_price" value="400" id="price_below400">
  <label for="price_below400">Below RM400</label><br>
  <br>
  <input type="submit" value="Apply Filters">
</form>
</div>
<div class="product">
<?php
  $brand = isset($_POST['brand']) ? $_POST['brand'] : '';
  $price = isset($_POST['product_price']) ? $_POST['product_price'] : '';

  $query = "SELECT * FROM webiste.product WHERE product_category = 'Kids'";

  
  if (!empty($brand)) {
      $query .= " AND brand = '$brand'";
  }

  if (!empty($price)) {
      $query .= " AND product_price <= '$price'";
  }
  
  $result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($result)) {
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