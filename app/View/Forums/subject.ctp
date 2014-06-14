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
<div class='response'>
	<div class='title'><?php 
		if (count($response) == 0) { echo "0 reponse"; }
		else if (count($response) == 1) { echo "1 reponse"; }
		else { echo count($response)." reponses"; }
	?></div>
	<?php
		for ($i = 0; isset($response[$i]); $i++) {
			echo "<div class='post'>";
				echo "<div class='markdown_txt markdown'>";
					echo $response[$i]['Forum_response']['text'];
				echo "</div>";
				echo "<div class='infos'>";
					echo "<div class='origin'>";
						echo "<span class='date'>".$response[$i]['Forum_response']['date']."</span>";
					echo "</div>";
					echo "<img src='data:image/png;base64,".$response[$i]['Forum_response']['picture']."'/>";
					echo "<span class='name'><a href='/users/profile/".$response[$i]['Forum_response']['author']."'>".$response[$i]['Forum_response']['uid']."</a></span>";
				echo "</div>";
			echo "</div>";
		}
	?>
</div>
<div class='answer'>
<div class='title'>Votre Reponse</div>
<?php
	echo $this->Form->create('response');
	echo "<div id='result' class='markdown response_result'></div>";
	echo $this->Form->input('text', array('type' => 'textarea', 'class' => 'mark', 'rows' => '25', 'label' => ''));
	echo $this->Form->end('Submit');
?>
</div>
