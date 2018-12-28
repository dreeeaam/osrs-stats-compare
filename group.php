<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<?php
			include("retrieve-player.php");
			// Get json group data
			$group_name = $_GET['view-group'];
			$json_filename = "groups/" . $group_name . ".json";
			$json_data = file_get_contents($json_filename);
			$group_data = json_decode($json_data, true);
			// Skills file
			$skills_file = file("skills.txt");
			$skills_color = array(1 => '#692007', 2 => '#6277be', 3 => '#04955a', 4 => '#837e7e', 5 => '#6d9017', 6 => '#9f9323', 7 => '#3250c1', 
			8 => '#702386', 9 => '#348c25', 10 => '#038d7d', 11 => '#6a84a4', 12 => '#bd7819', 13 => '#976e4d', 14 => '#6c6b52', 15 => '#5d8fa7', 
			16 => '#078509', 17 => '#3a3c89', 18 => '#6c3457', 19 => '#646464', 20 => '#65983f', 21 => '#aa8d1a', 22 => '#4f3f27', 23 => '#82745f');
			$total_skills = 24;
			// Get player stats
			$player1_stats = getPlayer($group_data['player1']);
			$player2_stats = getPlayer($group_data['player2']);
			$player3_stats = getPlayer($group_data['player3']);
			$player4_stats = getPlayer($group_data['player4']);
		?>
	</head>

	<body>
		<div class="main-content">
			<div class="title-div">
				<h1 class="title">OS-COMPARE</h1>
				<h1 id="group-name"><?php echo $group_data['name']; ?></h1>
				<h1 align="right">Last 7 days</h1>
			</div><br><br>
			<div class="players-wrapper">
				<table class="stat-table">
					<tr>
						<td id="empty-cell" colspan="2"></td>
						<th colspan="2"><?php echo $group_data['player1']; ?></th>
						<td rowspan="<?php echo $total_skills + 2; ?>" style="border-right: solid .5px;"></td>
						<th colspan="2"><?php echo $group_data['player2']; ?></th>
						<td rowspan="<?php echo $total_skills + 2; ?>" style="border-right: solid .5px;"></td>
						<th colspan="2"><?php echo $group_data['player3']; ?></th>
						<td rowspan="<?php echo $total_skills + 2; ?>" style="border-right: solid .5px;"></td>
						<th colspan="2"><?php echo $group_data['player4']; ?></th>
						<td rowspan="<?php echo $total_skills + 2; ?>" style="border-right: solid .5px;"></td>
					</tr>
					<tr>
						<th class="skill">Skills</th>
						<td rowspan="<?php echo $total_skills + 1; ?>" style="border-right: solid .5px;"></td>
						<?php for($x = 0; $x < 4; $x++) { ?>
							<th class="levels">Level</th>
							<th class="experience">Experience</th>
						<?php } ?>
					</tr>
					<?php for($x = 0; $x < $total_skills; $x++) { ?>
					<tr align="right">
						<td align="left" style="background-color: <?php echo $skills_color[$x]; ?>;"><?php echo $skills_file[$x]; ?></td>
						<td style="color: <?php echo $skills_color[$x]; ?>;"><?php echo $player1_stats[$x]['level']; ?></td>
						<td><?php echo number_format($player1_stats[$x]['experience']); 
								  //echo "(" . number_format($player1_gains[$x]) . ")"; ?></td>
						<td style="color: <?php echo $skills_color[$x]; ?>;"><?php echo $player2_stats[$x]['level']; ?></td>
						<td><?php echo number_format($player2_stats[$x]['experience']); ?></td>
						<td style="color: <?php echo $skills_color[$x]; ?>;"><?php echo $player3_stats[$x]['level']; ?></td>
						<td><?php echo number_format($player3_stats[$x]['experience']); ?></td>
						<td  style="color: <?php echo $skills_color[$x]; ?>;"><?php echo $player4_stats[$x]['level']; ?></td>
						<td><?php echo number_format($player4_stats[$x]['experience']); ?></td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</body>
</html>