<div id="forum">
	<h1>Derniers posts</h1>
		<table class='question'>
		<tr>
			<th class='icon'><i class='icon-question'></i> <i style='padding-left: 20%;' class='icon-bubbles2'></i></th>
			<th>Answers</th>
			<th>Views</th>
			<th>Module</th>
			<th>Subject</th>
			<th style='text-align: left; padding-left: 7%'>Title</th>
		</tr>
<?php
	for ($i = 0; isset($last[$i]); $i++) {
		echo "<tr class='space'>";
			echo "<td class='type'>";
				if ($last[$i]['Forum']['type'] == 2)
					echo "<i class='icon-question'></i>";
				else
					echo "<i class='icon-bubbles2'></i>";
				echo "</td>";
				echo "<td class='answers'>".$last[$i]['Forum']['response']."</td>";
				echo "<td class='views'>".$last[$i]['Forum']['view']."</td>";
				echo "<td class='module'>".$last[$i]['Forum']['module']."</td>";
				echo "<td class='subject'>".$last[$i]['Forum']['subject']."</td>";
				echo "<td class='title'><span class='text'><a href='/forums/subject/".$last[$i]['Forum']['id']."'>".$last[$i]['Forum']['title']."</a></span><span class='author'><a href='/users/profile/".$last[$i]['Forum']['author']."'>".$last[$i]['Forum']['uid_auth']."</a></span></td>";
			echo "</tr>";
	}
?>
	</table>

	<h1>Vos derniers messages</h1>
		<table class='question'>
		<tr>
			<th class='icon'><i class='icon-question'></i> <i style='padding-left: 20%;' class='icon-bubbles2'></i></th>
			<th>Answers</th>
			<th>Views</th>
			<th>Module</th>
			<th>Subject</th>
			<th style='text-align: left; padding-left: 7%'>Title</th>
		</tr>
<?php
	$last = $me;
	for ($i = 0; isset($last[$i]); $i++) {
		echo "<tr class='space'>";
			echo "<td class='type'>";
				if ($last[$i]['Forum']['type'] == 2)
					echo "<i class='icon-question'></i>";
				else
					echo "<i class='icon-bubbles2'></i>";
				echo "</td>";
				echo "<td class='answers'>".$last[$i]['Forum']['response']."</td>";
				echo "<td class='views'>".$last[$i]['Forum']['view']."</td>";
				echo "<td class='module'>".$last[$i]['Forum']['module']."</td>";
				echo "<td class='subject'>".$last[$i]['Forum']['subject']."</td>";
				echo "<td class='title'><span class='text'><a href='/forums/subject/".$last[$i]['Forum']['id']."'>".$last[$i]['Forum']['title']."</a></span><span class='author'><a href='/users/profile/".$last[$i]['Forum']['author']."'>".$last[$i]['Forum']['uid_auth']."</a></span></td>";
			echo "</tr>";
	}
?>

	</table>
</div>
