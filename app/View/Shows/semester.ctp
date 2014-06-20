<div class='main'>
	<h1>Semester <?= $semester['Semester']['id'] ?></h1>
		<div class='under_title'>
			<label for='date'>Date de debut :</label>
			<span class='date' name='date'><?= $semester['Semester']['date_begin'] ?></span>
			<br />
			<label for='date2'>Date de fin :</label>
			<span class='date' name='date2'><?= $semester['Semester']['date_end'] ?></span>
			<h3>Modules</h3>
			<div class='under_sub_title'>
				<table>
				<?php
					for ($i = 0; isset($module[$i]); $i++) {
						echo "<tr><td class='name'>";
						echo $module[$i]['Module']['name'];
						echo "</td><td class='description'>";
						echo $module[$i]['Module']['description'];
						echo "</td><td class='inscrit'>";
						$inscrit = explode(",", $module[$i]['Module']['is_inscrit']);
						echo count($inscrit);
						echo "</td><td class='date'>";
						echo $module[$i]['Module']['date_begin'];
						echo "</td></tr>";
					}
				?>
				</table>
			</div>
		</div>
</div>
