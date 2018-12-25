<?php
include("retrieve-player.php");
// Get group name and player names
$group_name = $_GET['group-name'];
$player1 = $_GET['player1'];
$player2 = $_GET['player2'];
$player3 = $_GET['player3'];
$player4 = $_GET['player4'];
// Add players to an array
$players = array($player1, $player2, $player3, $player4);
// Create json file with group name and player names
$json_array = array('name' => $group_name,
					'player1' => $player1,
					'player2' => $player2,
					'player3' => $player3,
					'player4' => $player4);
// Encode the json file
$json_file = json_encode($json_array, JSON_PRETTY_PRINT);
$json_file_name = "groups/" . $group_name . ".json";
// Save json file
$fp = fopen($json_file_name, 'w');
fwrite($fp, $json_file);
fclose($fp);
// Add each player to the database
for($x = 0; $x < count($players); $x++) {
	// If the player did not create a group with all the players avaliable
	if($players[$x] === "") { break; }
	// Create json of player
	createJson($players[$x]);
}

header('Location: http://localhost/stats_compare/group.php?view-group=' . $group_name);

?>