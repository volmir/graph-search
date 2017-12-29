<?php

//declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class SimpleTest extends TestCase
{
    public function testCalc()
    {
        $result = 6 + 6;
        $this->assertEquals(12, $result);
    }

}