<p>This is the main content. To display a lightbox click <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">POPUP</a></p>
<div id="light" class="white_content">This is the lightbox content. <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"><i class='icon-close close'></i></a></div>
    <div id="fade" class="black_overlay"></div>

<div class='planning'>
<table class='t_planning'>
	<tr>
<?php
$today = array('day' => date('w', strtotime(date("Y-m-d"))), 'num' => date('d'));
for ($day = $today['day']; ;) {
	switch ($day) {
		case "0": echo "<th>Dimanche</th>"; break;
		case "1": echo "<th>Lundi</th>"; break;
		case "2": echo "<th>Mardi</th>"; break;
		case "3": echo "<th>Mercredi</th>"; break;
		case "4": echo "<th>Jeudi</th>"; break;
		case "5": echo "<th>Vendredi</th>"; break;
		case "6": echo "<th>Samedi</th>"; break;
	}
	if ($day == "6")
		$day = -1;
	$day++;
	if ($day == $today['day'])
		break ;
}

$future = date("Y-").date("m-").(date("d") + 6);

for ($i = 0, $date = date("Y-m-d"); $date <= $future; $i++) {
	$t_date = explode('-', $date);
	$day = $t_date[2];
	$m = $t_date[1];

	if ($i == 0)
		echo "<tr>";
	if ($i % 7 == 0 && $i != 0)
		echo "</tr><tr>";

	if ($day == "31" && ($m == "02" || $m == "04" || $m == "06" || $m == "9" || $m == "11")) {
		$day = "01";
		$m++;
		$m = "0".$m;
	} else if ($day == "32" && ($m == "01" || $m == "03" || $m == "05" || $m == "07" || $m == "08" || $m == "10" || $m == "12")) {
		$day = "01";
		$m++;
		$m = "0".$m;
	}

	echo "<td class='";

	for ($j = 0; isset($sub[$j]); $j++) {
		if ($sub[$j]['subjects']['date_begin'] <= $date && $date <= $sub[$j]['subjects']['date_end'])
			echo $sub[$j]['subjects']['id']." ";
	}
	echo "'>";
	if ((date('w', strtotime($date))) == 0)
		echo "<span class='date sunday'>".$day."</span>";
	else
		echo "<span class='date'>".$day."</span>";

	echo "<div class='events'>";

	for ($j = 0; isset($sub[$j]); $j++) {
		if ($sub[$j]['subjects']['date_begin'] <= $date && $date <= $sub[$j]['subjects']['date_end'])
			echo "<div class='circle' onMouseOver='planning(\"".$sub[$j]['subjects']['id']."\", \"".$sub[$j]['subjects']['color']."\")' onmouseout='un_planning(\"".$sub[$j]['subjects']['id']."\")' style='background: ".$sub[$j]['subjects']['color']."'></div>";
	}
	echo "</div></td>";

	$day++;
	if ($day < 10)
		$day = "0".$day;
	$date = $t_date[0]."-".$m."-".$day;
}
?>
</table>
</div>
	<div class='parent'>
		<div id="sujet">
			<?php
				for ($i = 0; isset($act_sub[$i]); $i++) {
					echo "<h2>".$act_sub[$i]['subjects']['name']." :</h2>";
					echo "<a href='/shows/subject/".$act_sub[$i]['subjects']['id']."'>Lien vers le sujet</a>";
					$inscrit = explode(',', $act_sub[$i]['subjects']['is_inscrit']);
					$is_inscrit = 0;
					for ($j = 0; isset($inscrit[$j]); $j++) {
						if ($inscrit[$j] == $this->Session->read('LDAP.User.uidnumber'))
							$is_inscrit = 1; break;
					}
					if ($is_inscrit == 0)
						echo "<p>N'oubliez pas de vous inscrire !</p>";
					else if ($is_inscrit == 1)
						echo "<p>Vous etes bien inscrit</p>";
					echo "<p>Vous avez jusqu'au ".$act_sub[$i]['subjects']['date_end']." pour rendre votre travail.</p>";
				echo "<br />";
				}
				if ($i == 0) {
					echo "<h1>Pas de sujet en ce moment</h1>";
				}
			?>
		</div>
	</div>
