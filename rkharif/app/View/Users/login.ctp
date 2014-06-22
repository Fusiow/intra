<center>
	<div id="img">
	<?= $this->Html->image('42_1.png', array('id' => 'img_1')); ?>
	<?= $this->Html->image('42_2.png', array('id' => 'img_2')); ?>
	</div>
	<h1>Se connecter</h1>

<?php
	echo $this->Form->create('login');
	echo $this->Form->input('username', array('placeholder' => 'Username', 'label' => '', 'required'));
	echo $this->Form->input('password', array('placeholder' => 'Password', 'label' => '', 'required'));
	echo $this->Form->end('Submit');
?>
</center>
