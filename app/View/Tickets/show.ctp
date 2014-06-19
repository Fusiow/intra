<?php
	echo "<center><h1>".$ticket[0]['Ticket']['name']."</h1></center>";
	echo "<div class='ticket_post ticket_origin'>";
		echo "<h3>".$ticket[0]['Ticket']['author']."</h3>";
		echo "<p>".$ticket[0]['Ticket']['text']."</p>";
		echo "<span class='date'>".$ticket[0]['Ticket']['date']."</span>";
	echo "</div>";
	
		for ($i = 0; isset($response[$i]); $i++) {
			echo "<div class='ticket_post'>";
				echo "<h3>".$response[$i]['Tickets_response']['author']."</h3>";
				echo "<p>".$response[$i]['Tickets_response']['text']."</p>";
			echo "</div>";
		}
		if ($i == 0) {
			echo "<h1>Pas de reponse pour le moment :(</h1>";
		}
		if ($ticket[0]['Ticket']['is_close'] == 1) {
			echo "<h1><i class='icon-close'></i> Ticket clos.</h1>";
		} else {
			echo "<h1>Repondre</h1>";
			echo $this->Form->create('ticket');
			echo $this->Form->input('text', array('type' => 'textarea', 'label' => ''));
			if ($ticket[0]['Ticket']['assigned'] == $this->Session->read('LDAP.User.uidnumber')){
				echo $this->Form->checkbox('is_close', array('label' => 'Fermer le ticket'));
			}
			echo $this->Form->end('Submit');
		}
?>
