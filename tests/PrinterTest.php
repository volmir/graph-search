<?php

use PHPUnit\Framework\TestCase;

final class PrinterTest extends TestCase
{
    
    protected function setUp()
    {
        $this->printer = new App\Printer();
    }
    
    public function testTnitInstance()
    {
        $this->assertInstanceOf(
            App\Printer::class,
            $this->printer
        );
    }

    public function testSetMessages()
    {
        $messages = [
            'Message 1',
            'Message 2'
        ];
        
        $this->printer->set($messages);
        
        $this->assertEquals(2, count($this->printer->messages));
    }    
}