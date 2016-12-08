<?php
$servername = "localhost";
$username = "root";
$password = "spartans";
$curDB = "elo";
// $port = 22;

// try {
//   $conn = new PDO("mysql:host=$servername;dbname=$curDB", $username, $password);
//   $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "<script>console.log('Connected Successfully');</script>";
// }
// catch(PDOException $e) {
//   echo "Connection failed: " . $e->getMessage();
// }

$conn = mysqli_connect($servername, $username, $password, $curDB);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "<script>console.log('Connected successfully')</script>";
 ?>
