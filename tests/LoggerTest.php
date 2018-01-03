<?php

use PHPUnit\Framework\TestCase;

final class LoggerTest extends TestCase
{
    
    protected function setUp()
    {
        $this->logger = new App\Logger();
    }    
    
    public function testTnitInstance()
    {
        $this->assertInstanceOf(
            App\Logger::class,
            $this->logger
        );
    }

    public function testSetGetMessages()
    {
        $this->logger->add('Message 1');
        $this->logger->add('Message 2');
        $messages = $this->logger->getMessages();
        
        $this->assertInternalType('array', $messages);
        $this->assertEquals(2, count($messages));
        
        $this->logger->clearMessages();
        $this->assertEquals(0, count($this->logger->getMessages()));        
    }    
}