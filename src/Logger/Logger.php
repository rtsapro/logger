<?php

namespace ONPP\Logger;

use Psr\Log\AbstractLogger;

/**
 * Class Logger
 * @package ONPP\Logger
 */
class Logger extends AbstractLogger
{
    protected $cid;
    protected $format = "%s    %s    %s    %s";
    protected $filePath;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $this->cid = substr(md5(uniqid(mt_rand(), true)), 0, 6);
        $this->filePath = $path;
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        $lines = explode("\n", $message);

        // prepare first line
        $lines[0] = sprintf($this->format, date('Y-m-d H:i:s'), $this->cid, str_pad($level, 9), $lines[0]);

        // prepare last lines
        if (sizeof($lines) > 1) {
            for ($i = 1; $i < sizeof($lines); $i++) {
                $lines[$i] = sprintf($this->format, date('Y-m-d H:i:s'), $this->cid, str_pad(' ', 9), $lines[$i]);
            }
        }

        // storing data
        file_put_contents($this->filePath, implode("\n", $lines) . "\n", FILE_APPEND);
    }
}
