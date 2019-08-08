<?php
/**
 * Created by PhpStorm.
 * User: adamwhitlock
 * Date: 8/7/19
 * Time: 7:34 PM
 */

namespace App\Test;

use \PHPUnit\Framework\TestCase;
use App\TestingStuff\Sample;

class SumTest extends TestCase
{
    public function setUp(): void
    {
        $this->Sum = new Sample();
    }

    public function tearDown(): void
    {
        unset($this->Sum);
    }

    /** @test */
    public function test()
    {
        $sum = $this->Sum->total([5, 5, 5, 5]);
        $this->assertEquals(
            20,
            $sum,
            "Test simple sum function for the best sum");
    }
}