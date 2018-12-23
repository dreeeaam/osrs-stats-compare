<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<?php
			// Get json group data
			$group_name = $_GET['view-group'];
			$json_filename = "groups/" . $group_name . ".json";
			$json_data = file_get_contents($json_filename);
			$group_data = json_decode($json_data, true);
		?>
	</head>

	<body>
		<h1 id="group-name"><?php echo $group_data['name']; ?></h1>
		<div class="players-wrapper">
			<?php for($x = 1; $x < count($group_data); $x++) { 
				$player = "player" . $x;
				// Get players json data
				$player_json_filename = "players/" . $group_data[$player] . ".json";
				$player_json_data = file_get_contents($player_json_filename);
				$player_data = json_decode($player_json_data, true);
			?>
			<div class="player">
				<h2><?php echo $group_data[$player]; ?></h2>
				<table class="player-table">
					<tr>
						<td><h3>Skill</h3></td>
						<td><h3>Rank</h3></td>
						<td><h3>Level</h3></td>
						<td><h3>Experience</h3></td>
					</tr>
				<?php for($y = 0; $y < count($player_data); $y++) { ?>
					<tr>
						<td><?php echo $player_data[$y]['skill']; ?></td>
						<td><?php echo $player_data[$y]['rank']; ?></td>
						<td><?php echo $player_data[$y]['level']; ?></td>
						<td><?php echo $player_data[$y]['experience']; ?></td>
					</tr>
				<?php } ?>
				</table>
			</div>
			<?php } ?>
		</div>
	</body>
</html>