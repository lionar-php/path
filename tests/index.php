<?php

use path\collection;

require __DIR__ . '/../vendor/autoload.php';

$path = new collection ( __DIR__ );

$path->add ( 'agreements', 'agreements' );
$path->add ( 'views', 'resources/views' );

var_dump ( $path->to ( 'agreements' ) );

var_dump ( $path->to ( 'views' ) );