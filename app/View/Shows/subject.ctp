<?php
	$inscrit = count(explode(',', $result['is_inscrit']));
	$is_inscrit = false;
	$uid_inscrit = explode(',', $result['is_inscrit']);
	for ($i = 0; isset($uid_inscrit[$i]); $i++) {
		if ($uid_inscrit[$i] == $this->Session->read('LDAP.User.uidnumber')) {
			$is_inscrit = true; 
			break;
		}
	}
?>

<div class='show_subject'>
	<video controls="controls">
		<source src="/app/webroot/<?= $videos[0]?>" type="video/mp4"/>
	</video>
	<div class='description'>
		<table><tr><td>
		<h1><?= $result['name']?></h1>
		</td></tr><tr><td>
		<p><?= $result['description']?></p>
		<?php
			echo "Ce sujet commence le: ".$result['date_begin']." et finit le: ".$result['date_end']."<br />";
			if (date("Y-m-d") < $result['date_insc_beg']) 
				echo "Les inscriptions commencent le: ".$result['date_insc_beg']." et finissent le: ".$result['date_insc_end'];
			else if (date("Y-m-d") > $result['date_insc_end'])
				echo "Vous avez rate les inscriptions";
			else if ($is_inscrit == false)
				echo "<a href='/shows/inscription_subject/".$result['id']."'>S'inscrire</a>";
			else
				echo "Vous etes bien inscrit !";
		?>
		</td><td>
		<canvas id="myChart"></canvas></td></tr></table>
	</div>
	<div class='pdf'>
	<iframe src="<?= "/app/webroot/files/".$result['id'].'/subject.pdf'?>"></iframe>
	</div>
</div>
<script>
var ctx = document.getElementById("myChart").getContext("2d");
var data = [
			{
				value : <?= $inscrit ?>,
				color: "#DC3522"
			},
			{
				value: <?= $result['restriction'] ?>,
				color: "#374140"
			}
			];
new Chart(ctx).Pie(data);
Pie.defaults = {
	segmentShowStroke : true,
	segmentStrokeColor : "#fff",
	segmentStrokeWidth : 2,
	animation : true,
	animationSteps : 100,
	animationEasing : "easeOutBounce",
	animateRotate : true,
	animateScale : false,
	onAnimationComplete : null
};
</script>
