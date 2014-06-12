<?php
	echo $this->Form->create('subject');
	echo $this->Form->input('title', array('placeholder' => 'Title of subject', 'label' => '', 'class' => 'title'));
	$options = array();

	foreach ($mods as $mod) {
		$options[$mod['Module']['id']] = $mod['Module']['name'];
	}
	echo $this->Form->input('module', array(
		'options' => $options,
		'label' => '',
		'id' => 'category'
	));
	echo $this->Form->input('sub_category', array(
		'options' => '',
		'label' => "",
		'id' => 'subcategory',
		'name' => 'data[subject][subject][]'
	));
?>
	<div id="subject_parent">
		<div id='result' class='markdown'></div>
		<?= $this->Form->input('text', array('type' => 'textarea', 'class' => 'mark', 'rows' => '50', 'label' => '')) ?>
	</div>
<?= $this->Form->end('Send') ?>
