<?php

use Htec\Logger\Entity\EventEntity;
use Htec\Logger\LoggerFactory;

require_once __DIR__ . '/../bootstrap.php';

$configFilePath = __DIR__ . '/../config/queue.conf.php';
/** @noinspection PhpUnhandledExceptionInspection */
$logger = LoggerFactory::createFromConfigFile($configFilePath);

$log = new EventEntity('type-Q1', 'name-Q1', 'performer-Q1', 'subject-Q1', ['meta-Q1' => [1, 2, 3, 'a' => 'b']]);
$logger->error($log);
