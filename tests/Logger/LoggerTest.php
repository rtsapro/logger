<?php

namespace ONPP\Logger;

class LoggerTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf('ONPP\Logger\Logger', new Logger(''));
    }
}