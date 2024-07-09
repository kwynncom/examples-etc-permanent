<?php

// How to get parsable JSON from mongosh

require_once('/opt/kwynn/kwutils.php'); // https://github.com/kwynncom/kwynn-php-general-utils/blob/master/kwutils.php
$q = "print(EJSON.stringify(db.getSiblingDB('test').getCollection('my_arbitrary_collection_name').find().toArray()))";

//		  dbnm ,  q, next 2 not relevant; last param accepts a raw query with true
$json = dbqcl::q('test', $q, false, '',		    true); // snapshot of current version below
// 

$a = json_decode($json, true);
$jsonPretty = json_encode($a, JSON_PRETTY_PRINT);
echo($jsonPretty);
