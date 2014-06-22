<h1>Creation d'un Sujet</h1><br/>
<?php
	echo $this->Form->create('subject', array('type' => 'file'));
	echo $this->Form->input('name', array('placeholder' => 'Titre', 'label' => ''));
	echo $this->Form->input('description', array('type' => 'textarea', 'placeholder' => 'Description du sujet', 'label' => '',  'rows' => '5', 'cols' => '50'));
	echo $this->Form->input('restriction', array('placeholder' => 'Nombre de place', 'label' => '', 'type' => 'number'));
	echo '<table>
				<tr>
					<td><label>Date d\'inscription du: </label><input type="date" name="data[subject][date_insc_beg]"><label> au: </label><input type="date" name="data[subject][date_insc_end]"></td>
				</tr>';
	echo '<tr><td><label>Date du sujet du: </label><input type="date" name="data[subject][date_begin]"><label> au: </label><input type="date" name="data[subject][date_end]"></td></tr>';
	
	echo '<tr><td><label for="data[subject][hour_begin]">Heure de debut</label><input type="time" name="data[subject][hour_begin]" />';
	echo '<label for="data[subject][hour_end]"> Heure de fin</label><input type="time" name="data[subject][hour_end]" /></td></tr></table>';
	echo $this->Form->input('grp_size', array('placeholder' => 'Taille du groupe', 'label' => '', 'type' => 'number'));
	echo $this->Form->input('correction', array('placeholder' => 'Corrections', 'label' => '', 'type' => 'number'));
	echo $this->Form->input('automatic', array(
		'options' => array('1' => "Oui", '0' => "Non"),
		'label' => 'Generation automatique des groupes :'
		));
	
	foreach ($mods as $mod) {
		$options[$mod['Module']['id']] = $mod['Module']['name'];
	}
	echo $this->Form->input('module_id', array(
		'options' => $options,
		'label' => 'Module :'
	));
	echo $this->Form->input('type', array(
		'options' => array('1' => 'Projet / Examen', "2" => 'TD'),
		'label' => 'Type :'
	));
	echo $this->Form->input('subject_file', array('type' => 'file', 'label' =>'Sujet :'));
	echo "<input type='color' name='data[subject][color]'>";
	echo "<br />";
	echo $this->Form->end('Submit');
?>
