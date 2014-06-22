<div class="profile">
	<?php
		if (isset($me)) {
	//		echo "Personaliser mon profil";
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
?></span>
</div>
<div class='infos'>
<center>
	<canvas id="notes" width="800" height="200"></canvas>
</center>
</div>
<script>
	var ctx = document.getElementById("notes").getContext("2d");
	var data = {

		labels: [<?php
			for ($i = 0; isset($subject[$i]); $i++) {
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
