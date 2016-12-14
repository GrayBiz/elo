<?php
include "connection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['tb'])) {
  $tb = $_GET['tb'];
  switch ($tb) {
    case 'players': $tbl = 'players'; break;
    case 'games':   $tbl = 'games';   break;
    default: echo "STOP BREAKING THINGS"; break;
  };

};
if (isset($_GET['cmd'])){
  $cmd = $_GET['cmd'];
  switch ($cmd) {
    case 'getPlayers': $query= "SELECT * FROM players";  break;
    case 'getGames': $query= "SELECT * FROM games" ; break;
    case 'getTeam' : $query= "SELECT id, elo FROM players"; sortPlayers(); break;
    default: echo "STOP BREAKING THINGS"; break;
  };

};
if (isset($_GET['id'])){
  $id = $_GET['id'];
  $idArray = '(' . join(',', $id) .')';
  $query .= ' WHERE id in ' .$idArray;
};

// SELECT `id`, `elo` FROM `players` WHERE `id` in (4,6,7,11)

function sortPlayers() {
  global $conn, $query;
  $result = mysqli_query($conn, $query);

  if(!$result) {
    die('Query FAILED' );
  }

  $resultArray = Array();

  $output_array = "0";
  while($row = mysqli_fetch_assoc($result)) {
    $resultArray[] = $row;
  }

  $jsonEnc = json_encode($resultArray);

  echo $jsonEnc;
  print_r($resultArray);
  // print_r(json_decode($jsonEnc, true));
  mysqli_close($conn);



  $teamA = array();
  $teamATotal = 0;
  $teamB = array();
  $teamBTotal = 0;

  echo "</br>";
  echo "Printing Result Array " .
  print_r($resultArray);
  echo "</br>test";
  echo "</br>";
  echo "</br>";

  // $players = array(
  //   array("id" => 1, "elo" => 1230),
  //   array("id" => 2, "elo" => 1568),
  //   array("id" => 3, "elo" => 1120),
  //   array("id" => 4, "elo" => 1680),
  //   array("id" => 5, "elo" => 1369),
  //   array("id" => 6, "elo" => 1485),
  //   array("id" => 7, "elo" => 1400),
  //   array("id" => 8, "elo" => 1400),
  //   array("id" => 9, "elo" => 1423),
  //   array("id" => 10, "elo" => 1511),
  //   array("id" => 11, "elo" => 1236)
  // );

  foreach ($resultArray as $player) {
    foreach($player as $key => $value){
      if(!isset($sortArray[$key])){
        $sortArray[$key] = array();
      }
      $sortArray[$key][] = $value;
    }
  }
  $orderby = "elo";
  array_multisort($sortArray[$orderby], SORT_DESC,$players);
  // print_r($players);
  // print_r($players[5]['elo']);

  foreach (array_slice($players, 0, 10) as $player) {
      print_r("ID: " .$player['id'] ." ");
      print_r("ELO: ".$player['elo']."</br>");

      if (($teamATotal <= $teamBTotal && (count($teamA) < 5)) || (count($teamB) >= 5)) {
        $teamA[] = $player['id'];
        $teamATotal += $player['elo'];
      }
      else {
        $teamB[] = $player['id'];
        $teamBTotal += $player["elo"];
      }
  }


  echo "</br>";
  print_r("Team A: ".implode(" ,", $teamA)." Total ELO: ".$teamATotal. "</br>");
  print_r("Team A: ".implode(" ,", $teamB)." Total ELO: ".$teamBTotal. "</br>");
  echo "</br>";


}




$result = mysqli_query($conn, $query);

if(!$result) {
  die('Query FAILED' );
}

$resultArray = Array();

$output_array = "0";
while($row = mysqli_fetch_assoc($result)) {
  $resultArray[] = $row;
}

$jsonEnc = json_encode($resultArray);

echo $jsonEnc;
print_r($resultArray[0]);
// print_r(json_decode($jsonEnc, true));
mysqli_close($conn);





 ?>
