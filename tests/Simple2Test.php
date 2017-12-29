<?php

//declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class Simple2Test extends TestCase
{
    public function testCalc2()
    {
        $result = 6 + 6;
        $this->assertEquals(13, $result);
    }

}