<?php

namespace Htec\Logger\Writer;

use Htec\Logger\Entity\LogEntity;

/**
 * Class NullWriter
 */
class NullWriter extends AbstractWriter
{

    /**
     * @param LogEntity $log
     */
    public function write(LogEntity $log): void
    {
    }
}
