<?php

$total_skills = 24;

// Get Stats
$player_name = $_GET['player'];
$stats_string = "https://secure.runescape.com/m=hiscore_oldschool/index_lite.ws?player=" . $player_name;
$player_stats = file_get_contents($stats_string);
$split_stats = preg_split("/[\s,]+/", $player_stats);

// Prepare stats for show - 1st Rank, 2nd Level, 3rd Experience
$skill_names = file("levels.txt");
for($y = 0; $y < $total_skills; $y++) {
	for($x = 0; $x <= 2; $x++) {
		
	}
}
//list($rank, $level, $xp) = preg_split("/[\s,]+/", $player_stats);


// Send stats into table to show
print_r($rank);

?>