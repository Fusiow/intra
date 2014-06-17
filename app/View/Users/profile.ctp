<style type="text/css">
	.gros_div {	
		border: 15px solid black;
		height: 350px;
	}
	.picture {
		float: left;
	}

	.picture img {
		position: relative;
		height: 320px;
	}

	.summary {
		float: left;
		margin-left: 10px;
		margin-top: 50px;
	}
	.table {
		border-width: 5px;
		border-style: solid;
		width: 100%;
		border-collapse: collapse;
	}
	.table td {
		border-width: 1px;
		border-style: solid;
	}

	.sub_table {
		display: none;
	}
</style>

<div class="gros_div">
	<?php
		if (isset($me)) {
			echo "Personaliser mon profil";
		}
	?>
	<div class="picture" >
 		<?php
 		echo '<img src="data:image/png;base64, '.base64_encode($infos[0]['picture'][0]).'" />';
 		?>
	</div>
	<div class="summary">
	 	<?= 'Prenom: '.$infos[0]['first-name'][0].''; ?> </br> </br>  
	 	<?= 'Nom: '.$infos[0]['last-name'][0].''; ?> </br>  </br>  
	  	<?php 
	  	$piscine = $infos[0]['other'][0];
	  	if (!strcmp($piscine, "piscine-1"))
	  		echo 'Piscine: Juillet';
	  	else if (!strcmp($piscine, "piscine-2"))
	  		echo 'Piscine: Août';
	  	else
	  		echo 'Piscine: Septembre';
	  	?> </br> </br>  
	 	<?= 'Téléphone: '.$infos[0]['mobile-phone'][0].''; ?></br> </br>  
	</div>
</div>
</br>
</br>
</br>
</br>
<pre>
	</pre>
<table class='table'>
	<tr>
		<th>Inscrit au module</th>
		<th>Description</th>
	</tr>
<?php
	for ($i = 0; isset($module[$i]); $i++) {
		echo "<tr onclick=\"subMenu('table".$i."')\"><td>".$module[$i]['Name']."</td><td>".$module[$i]['Description']."</td></tr>";
		?>
		<tr><td><table>
	<?php

		for ($i2 = 0; isset($subject[$i2]); $i2++) {
			
			$id = $subject[$i2]['id'];
			if ($subject[$i2]['module_id'] == $module[$i]['id']) {
			echo "<tr class='sub_table sub_table".$i."'>";
			echo "<td>".$subject[$i2]['name']."</td>";
			echo "<td>".$subject[$i2]['description']."</td>";
			echo "<td>";
			for ($j = 1; isset($note[$subject[$i2]['id']]['note']['note'][$j]); $j++) {
				echo $note[$id]['note']['note'][$j].", ";
			}
			echo "</td>";
			if (isset($note[$id])) 
				echo "<td>".$note[$id]['note']['finale_note']."</td>";
			else
				echo "<td></td>";
			echo "</tr>";
		}
		}
		echo "</table></td></tr>";
?>
<?php } ?>
</table>


