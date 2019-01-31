<?php

use Htec\Logger\Core\DotEnv;
use Htec\Logger\Formatter\CsvFormatter;
use Htec\Logger\Formatter\HtmlFormatter;
use Htec\Logger\Formatter\MySqlFormatter;
use Htec\Logger\Formatter\StringFormatter;
use Htec\Logger\LogLevel;
use Htec\Logger\Writer\FileWriter;
use Htec\Logger\Writer\MailWriter;
use Htec\Logger\Writer\MySqlWriter;
use Htec\Logger\Writer\StdErrWriter;

return [
    'file' => [
        'writer' => FileWriter::class,
        'writer_config' => [
            'formatter' => CsvFormatter::class,
            'location' => DotEnv::get('LOGGER_LOGS_LOCATION', '/tmp/logs/htec.log'),
            'prepend_date' => true,
        ],
    ],
    'mysql' => [
        'writer' => MySqlWriter::class,
        'level' => LogLevel::ERROR,
        'writer_config' => [
            'formatter' => MySqlFormatter::class,
            'dsn' => DotEnv::get('LOGGER_MYSQL_DSN'),
            'username' => DotEnv::get('LOGGER_MYSQL_USERNAME'),
            'password' => DotEnv::get('LOGGER_MYSQL_PASSWORD'),
            'table' => DotEnv::get('LOGGER_MYSQL_TABLE'),
        ],
    ],
    'mail' => [
        'writer' => MailWriter::class,
        'level' => LogLevel::EMERGENCY,
        'bubble' => false,
        'writer_config' => [
            'formatter' => HtmlFormatter::class,
            'from' => DotEnv::get('LOGGER_EMAIL_FROM', 'somebody@example.com'),
            'to' => DotEnv::get('LOGGER_EMAIL_TO', 'somebody@example.com'),
            'subject' => DotEnv::get('LOGGER_EMAIL_SUBJECT', 'HTEC Logger - new event'),
            'host' => DotEnv::get('LOGGER_EMAIL_HOST'),
            'port' => DotEnv::get('LOGGER_EMAIL_PORT'),
            'username' => DotEnv::get('LOGGER_EMAIL_USERNAME'),
            'password' => DotEnv::get('LOGGER_EMAIL_PASSWORD'),
        ],
    ],
    'stderr' => [
        'writer' => StdErrWriter::class,
        'writer_config' => [
            'formatter' => StringFormatter::class,
        ]
    ]
];
