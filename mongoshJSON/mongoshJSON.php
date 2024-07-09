<?php

// How to get parsable JSON from mongosh

require_once('/opt/kwynn/kwutils.php'); // https://github.com/kwynncom/kwynn-php-general-utils/blob/master/kwutils.php
$q = "print(EJSON.stringify(db.getSiblingDB('test').getCollection('my_arbitrary_collection_name').find().toArray()))";

// The following function is the equivalent of running the query in the mongosh shell "by hand."  The function executes mongosh.
//		  dbnm ,  q, next 2 not relevant; last param accepts a raw query with true - raw as opposed to adding the toArray and print and whatnot.
$json = dbqcl::q('test', $q, false, '',		    true); // in https://github.com/kwynncom/kwynn-php-general-utils/blob/master/mongoDBcli.php
$a = json_decode($json, true);
$jsonPretty = json_encode($a, JSON_PRETTY_PRINT);
echo($jsonPretty); // prove it works
