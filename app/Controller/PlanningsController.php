<?php
class PlanningsController extends AppController {

	public $uses = array('Module', 'Subject');

	public function index() {
		$date = date("Y-m-d");
		$res = $this->Subject->query("SELECT * FROM subjects WHERE date_begin >= '".$date."'");
		$this->set('sub', $res);
	}
}
?>
