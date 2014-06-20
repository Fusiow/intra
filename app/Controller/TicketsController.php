<?php

/**
 * Tickets main class
 */
class TicketsController extends AppController
{
	public $uses = array('User', 'Ticket', 'Tickets_response');

	public function index() {
		if ($this->request->is('post')) {
			$this->request->data['Ticket']['author'] = $this->Session->read('LDAP.User.uid');
			$this->request->data['Ticket']['date'] = date('Y')."-".date("m")."-".date('d');
			$this->Ticket->save($this->request->data['Ticket']);

		}

		$res = $this->User->find('all', array('conditions' => array('id' => $this->Session->read('LDAP.User.uidnumber'))));
		if ($res[0]['User']['admin'] == 1) {
			$this->set('ticket', $this->Ticket->find('all', array('conditions' => array('assigned' => "0"), 'order' => array('priority' => 'desc'))));
		} else {
			$ticket = $this->Ticket->find('all', array('conditions' => array('author' => $this->Session->read('LDAP.User.uid'))));
			$this->set('t_load', $ticket);
		}
	}

	public function show($id) {
		$res = $this->Ticket->find('all', array('conditions' => array('id' => $id)));
		if ($this->Session->read('LDAP.User.uid') == $res[0]['Ticket']['author'] ||
			$this->Session->read('LDAP.User.uid') == $res[0]['Ticket']['assigned']) {

				if ($this->request->is('post')) {
					$this->request->data['ticket']['ticket_id'] = $id;
					$this->request->data['ticket']['author'] = $this->Session->read('LDAP.User.uid');
					if ($this->request->data['ticket']['is_close'] == 1) {
						$this->Ticket->id = $id;
						$this->Ticket->saveField('is_close', "1");
					}
					$this->Tickets_response->save($this->request->data['ticket']);
				}
			
			$response = $this->Tickets_response->find('all', array('conditions' => array('ticket_id' => $res[0]['Ticket']['id'])));
			$this->set('ticket', $res);
			$this->set('response', $response);
		} else {
			$this->redirect('/');
		}
	}

	public function take_it($id) {
		$admin = $this->User->find('all', array('conditions' => array('id' => $this->Session->read('LDAP.User.uidnumber'))));
		if ($admin[0]['User']['admin'] == 1) {
			$this->Ticket->id = $id;
			$this->Ticket->saveField('assigned', $this->Session->read('LDAP.User.uidnumber'));
			$this->redirect(array('action' => 'show', $id));
		} else {
			$this->redirect('/');
		}
	}
}

?>
