<?php

use TheNativeDeveloper\RapidWire\Combiner;
use TheNativeDeveloper\RapidWire\RapidWire;

require_once('./vendor/autoload.php');

$rapid = new RapidWire();

$combiner = $rapid->get(Combiner::class);

echo $combiner->print();
