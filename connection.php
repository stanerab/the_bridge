<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Detect if running locally or on InfinityFree
if ($_SERVER['SERVER_NAME'] == 'localhost') {
  // local development
  $host = "localhost";
  $user = "root";
  $pass = "";
  $db = "adhdbridge";
} else {
  // live InfinityFree server
  $host = "sql100.infinityfree.com";
  $user = "if0_40168601_adhdbridge";
  $pass = "Stanleyson00";
  $db = "if0_40168601_adhdbridge";
}

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
