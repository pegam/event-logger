<?php

namespace Htec\Logger\Formatter;

use Htec\Logger\Entity\LogEntity;
use Htec\Logger\Exception\FatalException;

/**
 * Class CsvFormatter
 */
class CsvFormatter extends AbstractFormatter implements FileFormatterInterface
{

    /**
     * @param LogEntity $log
     *
     * @return string
     *
     * @throws FatalException
     */
    public function format(LogEntity $log): string
    {
        return $this->createCsvLine($log->toArray());
    }

    /**
     * @param LogEntity $log
     *
     * @return string
     *
     * @throws FatalException
     */
    public function getHeaderLine(LogEntity $log): string
    {
        return $this->createCsvLine(array_keys($log->toArray()));
    }

    /**
     * @param array $data
     *
     * @return string
     *
     * @throws FatalException
     */
    private function createCsvLine(array $data): string
    {
        $fp = fopen('php://memory', 'rb+');
        $status = fputcsv($fp, $data);
        if (false === $status) {
            throw new FatalException('Can not create CSV line');
        }
        rewind($fp);
        return (string)stream_get_contents($fp);
    }
}
