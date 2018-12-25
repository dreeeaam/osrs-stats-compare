<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<?php
			// Get json group data
			$group_name = $_GET['view-group'];
			$json_filename = "groups/" . $group_name . ".json";
			$json_data = file_get_contents($json_filename);
			$group_data = json_decode($json_data, true);
			// Skills file
			$skills_file = file("skills.txt");
			$total_skills = 24;		
			// Player names
			$player1 = file_get_contents("players/" . $group_data['player1'] . ".json");
			$player1_data = json_decode($player1, true);
			$player2 = file_get_contents("players/" . $group_data['player2'] . ".json");
			$player2_data = json_decode($player2, true);
			$player3 = file_get_contents("players/" . $group_data['player3'] . ".json");
			$player3_data = json_decode($player3, true);
			$player4 = file_get_contents("players/" . $group_data['player4'] . ".json");
			$player4_data = json_decode($player4, true);
		?>
	</head>

	<body>
		<div class="main-content">
			<div class="title-div">
				<h1 class="title">OS-COMPARE</h1>
				<h1 id="group-name"><?php echo $group_data['name']; ?></h1>
			</div><br><br>
			<div class="players-wrapper">
				<table class="stat-table">
					<!-- Headers, Skills and player names !-->
					<tr>
						<td id="empty-cell"></td>
						<?php for($x = 1; $x < count($group_data); $x++) { 
							$player = "player" . $x;
							// Get players json data
							$player_json_filename = "players/" . $group_data[$player] . ".json";
							$players[] = $group_data[$player];
							$player_json_data = file_get_contents($player_json_filename);
							$player_data = json_decode($player_json_data, true);
						?>
							<th colspan="2"><?php echo $group_data[$player]; ?></th>
						<?php } ?>	
					</tr>
					<!-- Levels and experience sub headers !-->
					<tr style="background-color: grey;">
						<th>Skills</th>
						<?php for($x = 0; $x < 4; $x++) { ?>
							<th class="level">Level</th>
							<th class="experience">Experience</th>
						<?php } ?>
					</tr>
					<!-- Skills and levels !-->
					<?php for($x = 0; $x < $total_skills; $x++) { ?>
						<tr>
							<td><?php echo $skills_file[$x]; ?></td>
							<td><?php echo $player1_data[$x]['level']; ?></td>
							<td><?php echo $player1_data[$x]['experience']; ?></td>
							<td><?php echo $player2_data[$x]['level']; ?></td>
							<td><?php echo $player2_data[$x]['experience']; ?></td>
							<td><?php echo $player3_data[$x]['level']; ?></td>
							<td><?php echo $player3_data[$x]['experience']; ?></td>
							<td><?php echo $player4_data[$x]['level']; ?></td>
							<td><?php echo $player4_data[$x]['experience']; ?></td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</body>
</html>