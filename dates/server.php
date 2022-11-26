<?php

require_once('/opt/kwynn/kwutils.php');

doit();

function doit() {
    kwas(isset($_REQUEST['formats']), 'no format sent');
    $fs =      $_REQUEST['formats'];
    $a = json_decode($fs, 1);
    $ra = [];
    
    $o = new DateTimeImmutable();
    
    foreach($a as $f) {    
	kwas(!preg_match('/^[^A-Za-z- \.-]+$/', $f), 'bad character');
	$ra[$f] = $o->format($f);
    }
    
    header('Content-Type: application/json');
    echo(json_encode($ra));
}
