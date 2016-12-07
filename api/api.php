<?php
include "connection.php";

ini_set('display_errors',1);
error_reporting(E_ALL);

$tb = $_GET['tb'];

switch ($tb) {
  case 'players': $tbl = 'players'; break;
  case 'games':   $tbl = 'games';   break;
  default: echo "STOP BREAKING THINGS"; break;
};

$query = "SELECT * FROM ".$tbl;
$result = mysqli_query($conn, $query);

if(!$result) {
  die('Query FAILED' );
}

$jsonData = Array();

$output_array = "0";
while($row = mysqli_fetch_assoc($result)) {
  $jsonData[] = $row;
}

$jsonEnc = json_encode($jsonData);

echo $jsonEnc;
print_r(json_decode($jsonEnc, true));
mysqli_close($conn);

 ?>
