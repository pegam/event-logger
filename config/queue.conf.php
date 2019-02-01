<?php

use Htec\Logger\Core\DotEnv;
use Htec\Logger\Formatter\JsonFormatter;
use Htec\Logger\Writer\BeanstalkdWriter;

return [
    'queue' => [
        'writer' => BeanstalkdWriter::class,
        'writer_config' => [
            'formatter' => JsonFormatter::class,
            'host' => DotEnv::get('BEANSTALKD_HOST'),
            'port' => (int)DotEnv::get('BEANSTALKD_PORT', 11300),
            'tube' => DotEnv::get('BEANSTALKD_TUBE', 'log_tube'),
        ],
    ],
];
