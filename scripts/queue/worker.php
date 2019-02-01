<?php

use Htec\Logger\Core\DotEnv;
use Htec\Logger\Entity\EventEntity;
use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Formatter\CsvFormatter;
use Htec\Logger\LogLevel;
use Htec\Logger\Writer\FileWriter;
use Pheanstalk\Exception\SocketException;
use \Pheanstalk\Pheanstalk;

require_once __DIR__ . '/../../bootstrap.php';

$host = DotEnv::get('BEANSTALKD_HOST');
$port = DotEnv::get('BEANSTALKD_PORT');
$tube = DotEnv::get('BEANSTALKD_TUBE');
$pheanstalk = new Pheanstalk($host, $port);
$formatter = new CsvFormatter([]);
/** @noinspection PhpUnhandledExceptionInspection */
$writer = new FileWriter(['location' => '/tmp/logs/queue.log', 'prepend_date' => true], $formatter);
while (true) {
    try {
        $job = $pheanstalk->watch($tube)->ignore('default')->reserve();
        if ($job) {
            $data = json_decode($job->getData(), true);
            $pheanstalk->delete($job);
            if (is_array($data)) {
                $event = new EventEntity(
                    $data['eventType'],
                    $data['eventName'],
                    $data['performerOfAction'],
                    $data['actionSubject'],
                    $data['meta'] ?? []
                );
                $time = (float) \DateTime::createFromFormat('Y-m-d H:i:s.u', $data['logTime'])->format('U.u');
                $log = new LogEntity($data['channelName'], LogLevel::getInt($data['logLevel']), $event, $time);
                /** @noinspection PhpUnhandledExceptionInspection */
                $writer->write($log);
            }
        }
        sleep(1);
    } /** @noinspection PhpRedundantCatchClauseInspection */ catch (SocketException $e) {
        $pheanstalk = new Pheanstalk($host, $port);
    }
}
