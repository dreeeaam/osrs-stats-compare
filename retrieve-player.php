<?php
// Create a function that adds the players stats to a json file
function getPlayer($rsn) {
	// Total skills and all the skill names
	$total_skills = 24;
	$skills = file("skills.txt");
	// Add name to stats string
	$stats_string = "https://secure.runescape.com/m=hiscore_oldschool/index_lite.ws?player=" . $rsn;
	$player_stats = file_get_contents($stats_string);
	// Split the stats
	$split_stats = preg_split("/[\s,]+/", $player_stats);
	$stat_array = array();
	// Get the players most recent xp gains.
	$player_gains = json_encode(getGains($rsn));
	// Add all the skill names, rank, level and xp to the players json file.
	$a = 0;
	for($x = 0; $x < ($total_skills * 3); $x++) {
		$json_array = array('skill' => $skills[$a],
					    	'rank' => $split_stats[$x],
							'level' => $split_stats[$x + 1],
							'experience' => $split_stats[$x + 2]);
		$x = $x + 2; $a++;
		// Save data into array
		$stat_array[] = $json_array;
	}
	// Encode a json file
	$json_file = json_encode($stat_array, JSON_PRETTY_PRINT);
	$json_file_name = "players/" . $rsn. ".json";
	// Save the json file
	$fp = fopen($json_file_name, 'w');
	fwrite($fp, $json_file);
	fclose($fp);
	// Return the stats so the group can present the stats.
	return $stat_array;
}

function updatePlayers() {
	// Update the players XP gains by using Crystalmathlabs.com API
	// This will update all players in the group
	$update_player = array();
	for($x = 1; $x < count($group_data); $x++) {
		$update_player[] = array("type" => "update",
								 "player" => urlencode($group_data['player' . $x]));	            
	}
	$update_json = json_encode($update_player);
	$update_link = "https://crystalmathlabs.com/tracker/api.php?multiquery=" . $update_json;
	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $update_link);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$result = curl_exec($ch);
		curl_close($ch);
}

function getGains($rsn) {
	// Get the players gains from crystalmathlabs.com API
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://crystalmathlabs.com/tracker/api.php?type=track&player=" . urlencode($rsn) . "&time=604800");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$player_gains = curl_exec($ch);
	// Tidy up the data
	$split_gains = preg_split("/[\s,]+/", $player_gains);
	$gains = array($split_gains);
	// Send it and close connection
	return $gains;
	curl_close($ch);
}

?>