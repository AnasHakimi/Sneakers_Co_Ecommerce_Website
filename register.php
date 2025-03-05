<?php

// check if the form has been submitted
if (isset($_POST['submit'])) {
  // connect to the database
  $mysqli = new mysqli('localhost', 'root', '', 'webiste');

  // check for errors in the connection
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }

  // get the form data
  $username = $mysqli->real_escape_string($_POST['username']);
  $password = $mysqli->real_escape_string($_POST['password']);
  $fullname = $mysqli->real_escape_string($_POST['fullname']);
  $address = $mysqli->real_escape_string($_POST['address']);
  $email = $mysqli->real_escape_string($_POST['email']);
  $phone = $mysqli->real_escape_string($_POST['phone']);

  // check if the username already exists in the database
  $query = "SELECT * FROM login WHERE username = '$username'";
  $result = $mysqli->query($query);
  if ($result->num_rows > 0) {
    // show an alert message if the username already exists
    echo "<script>alert('The username already exists. Please choose another username.'); window.location='registerform.html';</script>";
  } else {
    // insert the user's information into the database
    $query = "INSERT INTO login (username, password, fullname, address, email, phone) VALUES ('$username', '$password', '$fullname', '$address', '$email', '$phone')";
    $mysqli->query($query);

    // show an alert message and redirect to the next page
    echo "<script>alert('Successfully registered! Redirecting to the next page...'); window.location='login.html';</script>";
  }
}

?>

