<?php
$servername = "localhost";
$username = "root";
$password = "password";
$curDB = "elo";
$port = 3306;

$conn = mysqli_connect($servername, $username, $password, $curDB);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "<script>console.log('Connected successfully')</script>";

 ?>
