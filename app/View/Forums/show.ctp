<div id="forum">
	<h1><?= $name ?></h1>
<?php
	if (isset($subject)) {
			echo "<table class='question'>";
			echo "	<tr>
			<th class='icon'><i class='icon-question'></i> <i style='padding-left: 20%;' class='icon-bubbles2'></i></th>
			<th>Answers</th>
			<th>Views</th>
			<th style='text-align: left; padding-left: 7%'>Title</th>
		</tr>
";
		for ($i = 0; isset($subject[$i]); $i++) {
				echo "<tr class='space'>";
			echo "<td class='type'>";
				if ($subject[$i]['Forum']['type'] == 2) {
					echo "<i class='icon-question'></i>";
				} else {
					echo "<i class='icon-bubbles2'></i>";
				}
			echo "</td>";
				echo "<td class='answers'>".$c_answers[$subject[$i]['Forum']['id']]."</td>";
			echo "<td class='views'>".$subject[$i]['Forum']['view']."</td>";
			echo "<td class='	title'><a href='/forums/subject/".$subject[$i]['Forum']['id']."'><span class='text'>".$subject[$i]['Forum']['title']."</span></a><span class='author'>".$subject[$i]['Forum']['author']."</span></td>";
			echo "</tr>";
		}
			if ($i == 0) {
			}
			echo "</table>";
	} else if (isset($module)) {
			echo "<table class='question'>";
			echo "	<tr>
			<th>Posts</th>
			<th>Name</th>
		</tr>
		";
			for ($i = 0; isset($module[$i]); $i++) {
				echo "<tr class='space'>";
					echo "<td class='answers'>".$module[$i]['Subject']['posts']."</td>";
					echo "<td class='title'><a href='/forums/show/".$module[$i]['Subject']['module_id']."/".$module[$i]['Subject']['id']."'><span class='text'>".$module[$i]['Subject']['name']."</span></a></td>";
				echo "</tr>";
			}
		echo "</table>";
	}
?>
</div>
