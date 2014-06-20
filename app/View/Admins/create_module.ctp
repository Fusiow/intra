<div id="admin_module">
<h1>Creation d'un module</h1><br/>
<?php
	echo $this->Form->create('module');
	echo $this->Form->input('name', array('placeholder' => 'Nom du module', 'label' => ''));
	echo $this->Form->input('description', array('type' => 'textarea', 'placeholder' => 'Description du module', 'label' => '',  'rows' => '5', 'cols' => '50'));
	echo $this->Form->input('restriction', array('placeholder' => 'Nombre de place', 'label' => '', 'type' => 'number'));
	echo '<table>
				<tr>
					<td><label>Date d\'inscription du: </label><input type="date" name="data[module][date_insc_begin]"><label> au: </label><input type="date" name="data[module][date_insc_end]"></td>
				</tr>';
	echo '<tr><td><label>Date du module du: </label><input type="date" name="data[module][date_begin]"><label> au: </label><input type="date" name="data[module][date_end]"></td></tr></table>';
	echo $this->Form->input('credit', array('placeholder' => 'nombre de credit', 'label' => '', 'type' => 'number'));
	echo "<br />";
	echo $this->Form->end('Submit');
?>
</div>
