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
	table {
		border-width: 5px;
		border-style: solid;
		width: 100%;
	}
	td {
		border-width: 1px;
		border-style: solid;
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
<table>
	<tr>
		<th>Inscrit au module</th>
		<th>Description</th>
	</tr>
<?php
	for ($i = 0; isset($module[$i]); $i++) {
		echo "<tr><td>".$module[$i]['Name']."</td><td>".$module[$i]['Description']."</td></tr>";
	}
?>
</table>