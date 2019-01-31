<?php

namespace Htec\Logger\Writer;

use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Exception\FatalException;
use Htec\Logger\Formatter\FormatterInterface;

/**
 * Class MailWriter
 */
class MailWriter extends AbstractWriter
{
    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $to;

    /**
     * @var string
     */
    private $subject;

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
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * FileWriter constructor.
     *
     * @param FormatterInterface $formatter
     *
     * @throws FatalException
     */
    public function __construct(FormatterInterface $formatter)
    {
        parent::__construct($formatter);
        if (empty($config['location']) || !is_string($config['location'])) {
            throw new FatalException('Missing or bad output file location');
        }
        $this->from = $config['from'];
        $this->to = $config['to'];
        $this->subject = $config['subject'];
        $this->host = $config['host'];
        $this->port = (int)$config['port'];
        $this->username = $config['username'];
        $this->password = $config['password'];
    }
    /**
     * @param LogEntity $log
     */
    public function write(LogEntity $log): void
    {
        $transport = new \Swift_SmtpTransport($this->host, $this->port);
        $transport->setUsername($this->username);
        $transport->setPassword($this->password);
        $mailer = new \Swift_Mailer($transport);
        $message = new \Swift_Message($this->subject);
        $message->setFrom($this->from);
        $message->setTo($this->to);
        $message->setBody($this->formatter->format($log), 'text/html');
        $mailer->send($message);
    }
}
