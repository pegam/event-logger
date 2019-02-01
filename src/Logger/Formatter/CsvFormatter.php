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
        $arr = $log->toArray();
        $arr['meta'] = json_encode($arr['meta']);
        return $this->createCsvLine($arr);
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
        if (false === $fp || false === fputcsv($fp, $data)) {
            throw new FatalException('Can not create CSV line');// @codeCoverageIgnore
        }
        rewind($fp);
        return rtrim((string)stream_get_contents($fp), "\r\n");
    }
}
