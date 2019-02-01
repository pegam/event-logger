<?php

namespace Htec\Logger\Writer;

use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Exception\FatalException;
use Htec\Logger\Formatter\FormatterInterface;
use Pheanstalk\Pheanstalk;

/**
 * Class BeanstalkdWriter
 */
class BeanstalkdWriter extends AbstractWriter
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $tube;

    /**
     * BeanstalkdWriter constructor.
     *
     * @param array              $config
     * @param FormatterInterface $formatter
     *
     * @throws FatalException
     */
    public function __construct(array $config, FormatterInterface $formatter)
    {
        parent::__construct($config, $formatter);
        if (empty($config['host']) || !is_string($config['host'])) {
            throw new FatalException('Missing or bad "host"');
        }
        if (empty($config['port']) || !is_int($config['port'])) {
            throw new FatalException('Missing or bad "port"');
        }
        if (empty($config['tube']) || !is_string($config['tube'])) {
            throw new FatalException('Missing or bad "tube"');
        }
        $this->host = $config['host'];
        $this->port = $config['port'];
        $this->tube = $config['tube'];
    }

    /**
     * @param LogEntity $log
     *
     * @throws FatalException
     */
    public function write(LogEntity $log): void
    {
        $pheanstalk = new Pheanstalk($this->host, $this->port);
        if (!$pheanstalk->getConnection()->isServiceListening()) {
            throw new FatalException('Queue is not running');
        }
        $pheanstalk->useTube($this->tube)->put($this->formatter->format($log));
    }
}
