<?php

use PHPUnit\Framework\TestCase;

final class LoggerTest extends TestCase
{
    public function testInstance()
    {
        $logger = new App\Logger();
        
        $this->assertInstanceOf(
            App\Logger::class,
            $logger
        );
    }

}