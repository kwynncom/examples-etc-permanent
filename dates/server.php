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
		if (0) $o->setTimestamp(strtotime('November 1, 2022')); // for testing
		$ret[] = [$f => $o->format($f)];
		if ($mo = $this->onMod($f, $o)) {
			$ret[] = [$f => $mo->format($f)];
		}
		
		return $ret;
	}
	
	private function onMod(string $fin, DateTime $oin) {
		
		$o = $oin;
		
		$fs = ['g', 'G', 'h', 'Y-m-d H:i:s'];
		foreach($fs as $f) if (strpos($fin, $f) !== false) { 
			$h = intval($o->format('G'));
			if ($h >= 22) { $o->sub(new DateInterval('PT15H')); return $o; }
			if ($h <  12) { $o->add(new DateInterval('PT12H')); return $o; }
		}
		$fs = ['j', 'd'];
		foreach($fs as $f) if (strpos($fin, $f) !== false) { 
			$d = intval($o->format('j'));
			if ($d >= 10) {
				$s = $d - 2;
				$o->sub(new DateInterval('P' . $s . 'D')); 
			}
			else { 
				$s = 10;
				$o->add(new DateInterval('P' . $s . 'D')); 
			}
			
			return $o; 
			
		}
		
		
		return false;
		
	}
}

new dateEx();
