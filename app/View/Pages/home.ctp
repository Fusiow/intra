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
	<div id="corrections" class='panel'>
		<span class='title'>Corrections</span><br />
		<br />
		<span class='sub-title'>Projet Intra <a href="#"><i class='icon-link'></i></a></span><br />
		<span class='element'>Valentin est <span class='green-style'>connecte</span></span><br />
		<span class='element'>Ryad est <span class='green-style'>connecte</span></span><br />
		<span class='element'>Matthieu est <span class='green-style'>connecte</span></span><br />
		<span class='element'>Vincent est <span class='red-style'>deconnecte</span></span><br />
		<span class='element'>Louis est <span class='red-style'>au dessus</span></span><br />

	</div>

	<!--
		News template:
			<span class='newglob'>
				<span class='member'>/* Lien vers le profil du membre */</span>
				<br /> // Retour a la ligne /!\
				<span class='action'>/* Evenement / Action du membre */</span>
				<br /> // Retour a la ligne /!\
			</span>
	-->
	<div id="news" class='panel'>
		<span class='newglob'>
			<span class='member'><a href="#">Ryad Kharif</a></span>
			<br />
			<span class='action'>A encore eu un 0 en Unix</span>
			<br />
		</span>
		<span class='newglob'>
			<span class='member'><a href="#">Matthieu Maudet</a></span>
			<br />
			<span class='action'>N'arrive pas a envoyer des binaires via ft_p</span>
			<br />
		</span>

	</div>
	</div>
