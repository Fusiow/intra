<div class='main'>
	<h1>Module <?= $module['Module']['name'] ?></h1>
		<div class='under_title'>
			<label for='date'>Date de debut :</label>
			<span class='date' name='date'><?= $module['Module']['date_begin'] ?></span>
			<br />
			<h3>Subject</h3>
			<div class='under_sub_title'>
				<table>
				<?php
					for ($i = 0; isset($subject[$i]); $i++) {
						echo "<tr><td class='name'>";
						echo $subject[$i]['Subject']['name'];
						echo "</td><td class='description'>";
						echo $subject[$i]['Subject']['description'];
						echo "</td><td class='inscrit'>";
						$inscrit = explode(",", $subject[$i]['Subject']['is_inscrit']);
						echo count($inscrit);
						echo "</td><td class='date'>";
						echo $subject[$i]['Subject']['date_begin'];
						echo "</td></tr>";
					}
				?>
				</table>
			</div>
		</div>
</div>
