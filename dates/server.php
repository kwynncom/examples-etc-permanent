<?php

require_once('/opt/kwynn/kwutils.php');

class dateEx {
	
	public function __construct() { 
		$this->do10();
		
	}
	
	private function do10() {
		kwas(isset($_REQUEST['formats']), 'no format sent');
		$fs =      $_REQUEST['formats'];
		$a = json_decode($fs, 1);
		$ra = [];

		foreach($a as $f) {    
			kwas(!preg_match('/^[^A-Za-z- \.-]+$/', $f), 'bad character');
			$res = $this->do20($f);
			foreach($res as $a) $ra[] = $a;
		}

		header('Content-Type: application/json');
		echo(json_encode($ra));
	}
	
	private function do20($f) {
		$ret = [];
		$o = new DateTime();
		if (strpos($f, 'g')) ; 
		$ret[] = [$f => $o->format($f)];		
		return $ret;
	}
}

new dateEx();
