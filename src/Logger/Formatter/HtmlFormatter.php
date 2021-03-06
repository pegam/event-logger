<?php

namespace Htec\Logger\Formatter;

use Htec\Logger\Entity\LogEntity;

/**
 * Class HtmlFormatter
 */
class HtmlFormatter extends AbstractFormatter
{

    /**
     * @param LogEntity $log
     *
     * @return string
     */
    public function format(LogEntity $log): string
    {
        $header = '';
        $body = '';
        foreach ($log->toArray() as $name => $value) {
            if ('meta' === $name) {
                $value = json_encode($value);
            }
            $header .= "<th>{$name}</th>\n";
            $body .= "<td>{$value}</td>\n";
        }
        return "
<table style=\"border-collapse:collapse;\" cellpadding=\"10\" border=\"1\">
    <thead>
        <tr>{$header}</tr>
    </thead>
    <tbody>
        <tr>{$body}</tr>
    </tbody>
</table>";
    }
}
