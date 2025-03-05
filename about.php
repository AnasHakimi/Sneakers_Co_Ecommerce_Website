<!DOCTYPE html>
<html>
<head>
<title>SNEAKER.CO</title>
<link href="css/about.css" rel="stylesheet" type="text/css"/>
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
    <div class="biglogo"><a><img src="images/biglogo.png"></a></div>
    <div class="desccnt">
    <div class="desc"><a>The company's main business is selling various types of branded shoes such as Nike, Adidas, Vans, 
        New Balance and others at retail prices. This company has just been established and is located at Jalan Sultan Zainal Abidin, 
        Kampung Surau Pasir, 20000 Kuala Terengganu, Terengganu at Mayang Mall. They have about five employees who manage the store and 
        the operating hours for this store are open every day from 10.30 am to 10.30 pm.</a></div>
        <div class="button">
        <button class="buttoninfo" onclick="document.location='https://goo.gl/maps/uCP379GN3vnmVn6Y9'"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
        <button class="buttoninfo"onclick="document.location=' https://wa.me/189085502'"><i class="fa fa-phone" aria-hidden="true"></i></button>
        </div>
</div>
</div>
<div class="team">
<h2>- Our Teams -</h2>
<div class="container1">
<table style="width:100%">
  <tr>
    <th>Members</th>
    <th>Details</th>
  </tr>
  <tr>
    <td><div class="picname"><a><img src="images/team1.JPG"></a><br>
      Muhammad Anas Hakimi Bin Khairul Anwar Zamani</div></td>
    <td>Position : Project Manager and Web Developer<br>
        Contact No : 018-9085502<br>
        Email : Hakimi11102@gmail.com
    </td>
   
  </tr>
  <tr>
    <td><div class="picname"><a><img src="images/team2.jpg"></a><br>
    Muhammad Haziq Bin Mohd Radzi</div></td>
    <td>Position : Database Designer 1<br>
        Contact No : 018-2762840<br>
        Email : 2020817678@student.edu.my
    </td>
  
  </tr>
   <tr>
    <td><div class="picname"><a><img src="images/team3.jpg"></a><br>
    Nik Muhammad Naqiuddin Bin Ibrahim</div>  </td>
    <td>Position : Database Designer 2<br>
        Contact No : 013-7458670<br>
        Email : 2020477776@student.edu.my
    </td>
  
  </tr>
</table>
</div>
</div>
<div class="footer">
<p>&copy 2023 Sneakers.co. All Rights Reserved</p>
</div>    
            </div>
           
</body>
</html>