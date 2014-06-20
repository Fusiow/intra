<?php
	if (isset($ticket)) {
		echo "<table class='ticket'>";
		echo "<tr>";
			echo "<th>Name</th>";
			echo "<th>Author</th>";
			echo "<th>Date</th>";
		echo "</tr>";
		for ($i = 0; isset($ticket[$i]); $i++) {
			if ($ticket[$i]['Ticket']['priority'] == 1)
				echo "<tr class='low'>";
			if ($ticket[$i]['Ticket']['priority'] == 2)
				echo "<tr class='middle'>";
			if ($ticket[$i]['Ticket']['priority'] == 3)
				echo "<tr class='high'>";
		
				echo "<td>".$ticket[$i]['Ticket']['name']."</td>";
				echo "<td>".$ticket[$i]['Ticket']['author']."</td>";
				echo "<td>".$ticket[$i]['Ticket']['date']."</td>";
				echo "<td><a href='/tickets/take_it/".$ticket[$i]['Ticket']['id']."'><button>Prendre ce Ticket</button></a></td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "<h1>Ticket en cours</h1>";
		for ($i = 0; isset($t_load[$i]); $i++) {
			while ($t_load[$i]['Ticket']['is_close'] == 1)
				$i++;
			echo "<a href='/tickets/show/".$t_load[$i]['Ticket']['id']."'>".$t_load[$i]['Ticket']['name']."</a><br />";
		}
		echo $this->Form->create('Ticket');
		echo $this->Form->input('name', array('placeholder' => 'Title', 'label' => ''));
		echo $this->Form->input('priority', array(
			'options' => array("1" => 'Basse', "2" => "Moyenne", "3" => "Haute"),
			'label' => 'Priority :'
		));
		echo $this->Form->input('text', array('type' => 'textarea', 'rows' => '10' ,'cols' => '50' ,'label' => ''));
		echo $this->Form->end('Submit');
	}
?>
