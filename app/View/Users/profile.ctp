<div class="profile">
	<?php
		if (isset($me)) {
	//		echo "Personaliser mon profil";
		}
		$credit = 0;
		for ($i = 0; isset($module[$i]); $i++) {
			$credit += $module[$i]['credit'];
		}
		for ($i = 0; isset($subject[$i]); $i++) {
			if (empty($note[$subject[$i]['id']]))
				$no_note[$subject[$i]] = 1;
		}
	?>
	<div class="picture" >
 		<?php
 		echo '<img src="data:image/png;base64, '.base64_encode($infos[0]['picture'][0]).'" />';
 		?>
	<br />
		<span class='name'><?= $infos[0]['uid'][0]?></span>
	<br />
		<span class='name bold'><?= $infos[0]['first-name'][0]." ".$infos[0]['last-name'][0] ?></span>
	<br />
	<span class='name'><?php 
		$q = $infos[0]['mobile-phone'][0];
		for ($i = 0; isset($q[$i]); $i++) {
			if (($i % 2 == 0) && $i != 0)
				echo " ";
			echo $q[$i];
		}
?></span><br /><div class='social'>
<?php
	if (isset($user[0]['User']['facebook'])) {
		echo "<a href='".$user[0]['User']['facebook']."'<i class='fa fa-facebook'></i></a>";
	}
	if (isset($user[0]['User']['twitter'])) {
		echo "<a href='".$user[0]['User']['twitter']."'<i class='fa fa-twitter'></i></a>";
	}
	if (isset($user[0]['User']['linkedin'])) {
		echo "<a href='".$user[0]['User']['facebook']."'<i class='fa fa-linkedin'></i></a>";
	}
	if (isset($user[0]['User']['google'])) {
		echo "<a href='".$user[0]['User']['google']."'<i class='fa fa-google-plus'></i></a>";
	}
	if (isset($user[0]['User']['github'])) {
		echo "<a href='".$user[0]['User']['github']."'<i class='fa fa-github'></i></a>";
	}
?>
</div>
</div>
<div class='infos'>
<h1>Notes</h1>
<center>
	<canvas id="notes" width="800" height="200"></canvas>
</center>
<h1>Modules</h1>
<div class='module'>
Credit en cours: <?= $credit ?><br />
<table>
	<tr>
		<th>Nom</th>
		<th>Credits</th>
		<th>Debut</th>
		<th>Fin</th>
	</tr>
<?php
	for ($i = 0; isset($module[$i]); $i++) {
		echo "<tr>";
			echo "<td class='td'>".$module[$i]['name']." <i onclick=\"show_sub('.sub_".$module[$i]['id']."')\" class='fa fa-chevron-down'></i></td>";
			echo "<td class='td'>".$module[$i]['credit']."</td>";
			echo "<td class='td'>".$module[$i]['date_begin']."</td>";
			echo "<td class='td'>".$module[$i]['date_end']."</td>";
		echo "</tr>";
		echo "<tr class='sub sub_".$module[$i]['id']."'><td class='sub_td'><table class='sub_table'>";
		for ($j = 0; isset($subject[$j]); $j++) {
			if ($subject[$j]['module_id'] == $module[$i]['id']) {
				echo "<tr>";
					echo "<td>".$subject[$j]['name']."</td>";
					echo "<td>".$note[$subject[$j]['id']]['note']['finale_note']."</td>";
				echo "</tr>";
			}
		}
		echo "</table></td></tr>";
	}
?>
</table>
</div>
</div>
<script>
	var ctx = document.getElementById("notes").getContext("2d");
	var data = {

		labels: [<?php
			for ($i = 0; isset($subject[$i]); $i++) {
				if ($no_note[$subject[$i]['id']] == 1)
					echo "\"".$subject[$i]['name']."\"";
				if (isset($subject[$i + 1]))
					echo ",";
			}
?>],
	datasets: [
			{
				fillColor: "#374140",
				strokeColor: "rgba(220, 220, 220, 1)",
				pointColor: "rgba(220, 220, 220, 1)",
				pointStrokeColor: "#fff",
				data: [<?php
			for ($i = 0; isset($subject[$i]); $i++) {
				if ($no_note[$subject[$i]['id']] == 1)
					echo "\"".$note[$subject[$i]['id']]['note']['finale_note']."\"";
				if (isset($subject[$i + 1]))
					echo ",";
			}

?>]
			}
	]
	}
		new Chart(ctx).Line(data);
</script>
