
<?php
session_start();


if (isset($_SESSION) && !empty($_SESSION)) {
    
    if(session_destroy()) {
        
        echo '<script>alert("Successful log out!"); window.location = "index.php";</script>';
    }
} else {
    // Display error message
    echo '<script>alert("You are not logged in!"); window.location = "login.html";</script>';
}

