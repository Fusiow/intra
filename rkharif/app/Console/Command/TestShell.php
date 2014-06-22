<?php

class TestShell extends Shell {
	public $uses = array('Subject', 'Correction');

	function corrections() {
		$id = !empty($this->args[0]) ? $this->args[0] : ”;
		$nb = !empty($this->args[1]) ? $this->args[1] : ”;
		$res = $this->Subject->find('all', array('conditions' => array('id' => $id)));
		$uid = explode(',', $res[0]['Subject']['is_inscrit']);
		$val = array();
		$keys = array_keys($uid);
		shuffle($keys);
		foreach($keys as $key) $val[] = $uid[$key];

		$corrections = array();
		$correcteurs = array();
		for ($i = 0; isset($val[$i]); $i++) {
			$corrections[$val[$i]] = array();
			for ($v = $i + 1, $j = 0; $j < $nb; $v++, $j++){
				if (!isset($val[$v]))
					$v = 0;
				$corrections[$val[$i]][$j]['uid'] = $val[$v];
				$corrections[$val[$i]][$j]['done'] = 0;
				$correcteurs[$val[$v]][] = $val[$i];
			}
		}
		for ($i = 0; isset($val[$i]); $i++)
			$this->Correction->saveAll(array('uid' => $val[$i], 'correcteur' => json_encode($correcteurs[$val[$i]]),'correction' => json_encode($corrections[$val[$i]]), 'subject_id' => $id));
	}
}
?>
