<?php

namespace Htec\Logger\Writer;

use Htec\Logger\Entity\LogEntity;

/**
 * Class StdErrWriter
 */
class StdErrWriter extends AbstractWriter
{

    /**
     * @param LogEntity $log
     */
    public function write(LogEntity $log): void
    {
        file_put_contents(STDERR, $this->formatter->format($log) . "\n");
    }
}
