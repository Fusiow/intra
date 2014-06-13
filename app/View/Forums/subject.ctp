<div class='subject'>
	<div class='title'><?= $result['title'] ?>
		<?php
			if ($result['type'] == 2) {
				echo "<i class='icon-question'></i>";
			} else {
				echo "<i class='icon-bubbles2'></i>";
			}
		?>
	</div>
	<div class='origin_post'>
		<div class='post'>
			<div class='markdown_txt markdown'>
				<?= $text ?>
			</div>
			<div class='infos'>
			<div class='origin'>
				<span class='date'><?= $result['date']; ?></span>
			</div>
			<img src="data:image/png;base64,<?= $author[0]['User']['picture'] ?>"/>
			<span class='name'><a href='/users/profile/<?= $author[0]['User']['id']?>'><?= $author[0]['User']['uid'] ?></a></span>
			</div>
		</div>
	</div>
</div>

<pre>
	<?= print_r($result); ?>
	<?= print_r($author); ?>
</pre>
