<?php
	echo $this->Form->create('subject');
	echo $this->Form->input('title', array('placeholder' => 'Title of subject', 'label' => '', 'class' => 'title'));
	$options = array();

	echo "<table class='newtable'><tr><td>";
	foreach ($mods as $mod) {
		$options[$mod['Module']['id']] = $mod['Module']['name'];
	}
	echo $this->Form->input('module', array(
		'options' => $options,
		'label' => '',
		'id' => 'category'
	));
	echo "</td><td>";
	echo $this->Form->input('sub_category', array(
		'options' => '',
		'label' => "",
		'id' => 'subcategory',
		'name' => 'data[subject][subject][]'
	));
?>
	</td>
	<td>
<div class="onoffswitch">
    <input type="checkbox" name="switchonoff" class="onoffswitch-checkbox" id="myonoffswitch" checked>
    <label class="onoffswitch-label" for="myonoffswitch">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span>
    </label>
</div>
	</td>
	</tr>
	</table>
	<div id="subject_parent">
		<div id='result' class='markdown'></div>
		<?= $this->Form->input('text', array('type' => 'textarea', 'class' => 'mark', 'rows' => '50', 'label' => '')) ?>
	</div>
<?= $this->Form->end('Send') ?>
