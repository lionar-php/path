<?php

use Path\Collection;

require __DIR__ . '/../vendor/autoload.php';


$path = new Collection ( __DIR__ );

// $path->add ( 'agreements', 'agreements' );

$path->add ( 'views', 'resources/views' );
$path->add ( 'agreements', 'application' );
var_dump ( $path->to ( 'agreements' ) );

var_dump ( $path->to ( 'views' ) );