<center>
	<?= $this->Html->image('42.png'); ?>
	<h1>Se connecter</h1>

<?php
	echo $this->Form->create('login');
	echo $this->Form->input('username', array('placeholder' => 'Username', 'label' => '', 'required'));
	echo $this->Form->input('password', array('placeholder' => 'Password', 'label' => '', 'required'));
	echo $this->Form->end('Submit');
?>
</center>
