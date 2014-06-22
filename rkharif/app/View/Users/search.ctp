<?php
	echo "<table class='search'>";
	for ($i = 0; isset($result[$i]); $i++) {
		echo "<tr>";
			echo "<td class='pic'><img src='data:image/png;base64, ".$result[$i]['User']['picture']."' /></td>";
			echo "<td><a href='/users/profile/".$result[$i]['User']['id']."'>".$result[$i]['User']['uid']."</a></td>";
		echo "</tr>";
	}
	echo "</table>";
?>
