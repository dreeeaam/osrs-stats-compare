<?php
// Create a function that adds the players stats to a json file
function createJson($rsn) {
	// Total skills and all the skill names
	$total_skills = 24;
	$skills = file("skills.txt");
	// Add name to stats string
	$stats_string = "https://secure.runescape.com/m=hiscore_oldschool/index_lite.ws?player=" . $rsn;
	$player_stats = file_get_contents($stats_string);
	// Split the stats
	$split_stats = preg_split("/[\s,]+/", $player_stats);
	$stat_array = array();
	// Add all the skill names, rank, level and xp to the players json file.
	$a = 0;
	for($x = 0; $x < ($total_skills * 3); $x++) {
		$json_array = array('skill' => $skills[$a],
					    	'rank' => $split_stats[$x],
							'level' => $split_stats[$x + 1],
							'experience' => $split_stats[$x + 2]);
		$x = $x + 2;
		$a++;
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
}

?>