<?php
  // Get the product ID from the query string
  $product_id = $_GET['id'];

  // Connect to the database
  $host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "webiste";
  
  $conn = new mysqli($host, $username, $password, $dbname);

  // Retrieve the product details from the database
  $sql = "SELECT * FROM product WHERE productID = $product_id";
  $result = mysqli_query($conn, $sql);
  $product = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>
<head>
	<title>SNEAKER.CO</title>
    <link rel="stylesheet" type="text/css" href="css/product.css"/>
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

<!-- Display the product details -->
<h1><?php echo $product['product_name']; ?></h1>

<div class="product">
<div class="shoesimages">
<img src="<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>">
</div>
<div class="detail">
<div class="shoesdesc">
<p>Details: <?php echo $product['product_desc']; ?></p>
</div>
<div class="shoesprice">
<p>Price: RM<?php echo $product['product_price']; ?></p>
</div>
<div class="shoessize">
Choose Size:
<form method='post' action='/website/cart.php?id=<?php echo $product_id ?>'>
    <input type='hidden' name='product_id' value='<?php echo $product_id ?>'>
    <?php
    $query = "SELECT size_id FROM variation WHERE productID = $product_id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $size_id = $row['size_id'];
            $query2 = "SELECT size_name FROM sizeproduct WHERE size_id = $size_id";
            $result2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($result2);
            $size_name = $row2['size_name'];
            echo "<input type='radio' name='size' value='$size_name'> $size_name <br>";
        }
    } else {
        echo "No results found for product_id: $product_id";
    }
    ?>
    <input class='buttonadd' type='submit' name='add_to_cart' value='Add to Cart'>
    <input class='buttonadd' type='submit' name='buy_now' value='Buy Now' onClick="submitForm(this.form,'/website/buycheckout.php?id=<?php echo $product_id ?>');">
</form>
<script>
    function submitForm(form, action) {
        form.action = action;
        form.submit();
    }
</script>



</div>
</div>
</div>
<?php

require_once 'connection.php';

$sql = "SELECT * FROM product";
$all_product = $conn->query($sql);

?>

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
    </div>

    </body>
</html>

