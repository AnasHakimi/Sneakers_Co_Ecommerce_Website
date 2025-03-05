<?php
// Start a session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  // The user is already logged in, show an error message
  echo '<script>alert("You have already logged in!"); window.location = "index.php";</script>';
  exit;
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Connect to the database
  $db = new mysqli('localhost', 'root', '', 'webiste');

  // Check if the username and password are correct
  $result = $db->query("SELECT * FROM login WHERE username = '$username' AND password = '$password'");
  if ($result->num_rows > 0) {
    // Login was successful, start a session and redirect to the next page
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    echo '<script>alert("Successful login!"); window.location = "index.php";</script>';
    exit;
  } else {
    // Login failed, show an error message
    echo '<script>alert("Incorrect username or password!"); window.location = "login.html";</script>';
  }
}

?>





