<?php   // checks if user have successfully log in or not
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php"); // redirect to login
    exit;
}


<?php
session_start();
session_destroy(); // log out
header("Location: index.php");
exit;
