<?php
// Database connection
$servername = "localhost";
$username = "adhd_user";      // your new user
$password = "mypassword";      // the password you set
$dbname = "login";

$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>