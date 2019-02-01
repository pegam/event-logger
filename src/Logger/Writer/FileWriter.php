<?php

namespace Htec\Logger\Writer;

use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Exception\FatalException;
use Htec\Logger\Formatter\CsvFormatter;
use Htec\Logger\Formatter\FormatterInterface;

/**
 * Class FileWriter
 */
class FileWriter extends AbstractWriter
{
    /**
     * @var CsvFormatter
     */
    protected $formatter;

    /**
     * @var string
     */
    private $filePath;

    /**
     * @var bool
     */
    private $prependDate;

    /**
     * FileWriter constructor.
     *
     * @param array              $config
     * @param FormatterInterface $formatter
     *
     * @throws FatalException
     */
    public function __construct(array $config, FormatterInterface $formatter)
    {
        parent::__construct($config, $formatter);
        if (empty($config['location']) || !is_string($config['location'])) {
            throw new FatalException('Missing or bad output file location');
        }
        $this->filePath = $config['location'];
        $this->prependDate = isset($config['prepend_date']) ? (bool)$config['prepend_date'] : false;
    }

    /**
     * @param LogEntity $log
     *
     * @throws FatalException
     */
    public function write(LogEntity $log): void
    {
        $filePath = $this->getFilePath();
        $fp = fopen($filePath, 'ab');
        if (false === $fp) {
            throw new FatalException('Can not open file "' . $filePath . '"');
        }
        flock($fp, LOCK_EX);
        if (file_exists($filePath) && 0 === filesize($filePath)) {
            $output = $this->formatter->getHeaderLine($log) . "\n";
            if (false === fwrite($fp, $output)) {
                throw new FatalException('Can not write to file "' . $filePath . '"');
            }
        }
        $output = $this->formatter->format($log) . "\n";
        if (false === fwrite($fp, $output)) {
            throw new FatalException('Can not write to file "' . $filePath . '"');
        }
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    /**
     * @return string
     *
     * @throws FatalException
     */
    private function getFilePath(): string
    {
        $pathInfo = pathinfo($this->filePath);
        $dirname = $pathInfo['dirname'];
        $basename = $pathInfo['basename'];
        if ($this->prependDate) {
            $basename = date('Y_m_d-') . $basename;
        }
        if (!is_dir($dirname) && !mkdir($dirname, 0777, true) && !is_dir($dirname)) {
            throw new FatalException('Can not create directory "' . $dirname . '"');
        }
        chmod($dirname, 0775);
        if (!is_writable($dirname)) {
            throw new FatalException('Can not write to directory "' . $dirname . '"');
        }
        return "{$dirname}/{$basename}";
    }
}
