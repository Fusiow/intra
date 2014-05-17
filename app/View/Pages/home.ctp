<p>This is the main content. To display a lightbox click <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">POPUP</a></p>
<div id="light" class="white_content">This is the lightbox content. <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"><i class='icon-close close'></i></a></div>
    <div id="fade" class="black_overlay"></div>
<div id="planning">
	<table>
		<tr>
			<th>Lundi</th>
			<th>Mardi</th>
			<th>Mercredi</th>
			<th>Jeudi</th>
			<th>Vendredi</th>
			<th>Samedi</th>
			<th>Dimanche</th>
		</tr>
		<tr>
			<td class='project'>1</td>
			<td class='project'>2</td>
			<td class='project'>3</td>
			<td class='project today'>4</td>
			<td class='nope'>5</td>
			<td class='nope'>6</td>
			<td class='nope'>7</td>
		</tr>
		<tr>
			<td class='nope'>8</td>
			<td class='nope'>9</td>
			<td class='noinscription'>10</td>
			<td class='noinscription'>11</td>
			<td class='noinscription'>12</td>
			<td class='project'>13</td>
			<td class='project'>14</td>
		</tr>

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
