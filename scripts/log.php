<?php

use Htec\Logger\Entity\EventEntity;
use Htec\Logger\LoggerFactory;

require_once __DIR__ . '/../bootstrap.php';

/** @noinspection PhpUnhandledExceptionInspection */
$logger = LoggerFactory::createDefault();

$log = new EventEntity('type1', 'name1', 'performer1', 'subject1');
$logger->warning($log);
$log = new EventEntity('type2', 'name2', 'performer2', 'subject2', ['meta2' => 123]);
$logger->error($log);
$log = new EventEntity('type3', 'name3', 'performer3', 'subject3');
$logger->emergency($log);

$log = new EventEntity('type4', 'name4', 'performer4', 'subject4', ['meta4' => 321]);
$logger->stack(['file', 'stderr'])->debug($log);

$log = new EventEntity('type5', 'name5', 'performer5', 'subject5', ['meta5' => 789]);
$logger->channel('stderr')->info($log);
