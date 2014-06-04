<?php

class ForumsController extends AppController {
	public function		index() {

	}

	public function		show() {
		$arg = explode("/", $this->here);
		if (count($arg) >= 5) {
			$module = $arg[count($arg) - 2];
			$subject = $arg[count($arg) - 1];
		} else {
			$module = $arg[count($arg) - 1];
			$subject = NULL;
		}
		echo "Le module est ".$module.", et le sujet :".$subject;
	}
}
?>
