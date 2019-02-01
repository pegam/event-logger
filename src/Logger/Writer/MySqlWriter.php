<?php

namespace Htec\Logger\Writer;

use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Exception\FatalException;
use Htec\Logger\Formatter\FormatterInterface;
use Htec\Logger\Formatter\MySqlFormatter;

/**
 * Class MySqlWriter
 */
class MySqlWriter extends AbstractWriter
{
    /**
     * @var MySqlFormatter
     */
    protected $formatter;

    /**
     * @var string
     */
    private $dsn;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var array
     */
    private $pdoOptions = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
    ];

    /**
     * MySqlWriter constructor.
     *
     * @param array              $config
     * @param FormatterInterface $formatter
     *
     * @throws FatalException
     */
    public function __construct(array $config, FormatterInterface $formatter)
    {
        parent::__construct($config, $formatter);
        if (empty($config['dsn']) || !is_string($config['dsn'])) {
            throw new FatalException('Missing or bad DSN');
        }
        if (empty($config['username']) || !is_string($config['username'])) {
            throw new FatalException('Missing or bad username');
        }
        $this->dsn = $config['dsn'];
        $this->username = $config['username'];
        $this->password = $config['password'];
    }

    /**
     * @param LogEntity $log
     *
     * @throws FatalException
     */
    public function write(LogEntity $log): void
    {
        $connection = new \PDO($this->dsn, $this->username, $this->password, $this->pdoOptions);
        $statement = $connection->prepare($this->formatter->format($log));
        $statement->execute($this->formatter->getParams($log));
    }
}
