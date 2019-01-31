<?php

use Htec\Logger\Core\DotEnv;

require __DIR__ . '/vendor/autoload.php';

$dotEnv = new DotEnv();
$dotEnv->load(__DIR__ . '/.env');
