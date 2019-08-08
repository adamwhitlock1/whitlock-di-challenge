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

    /** @test */
    public function test()
    {
        $class = new Sample();
        $sum = $class->total([5, 5, 5, 5]);
        $this->assertEquals(
            20,
            $sum,
            "Test simple sum function for the best summmmmmmmmmmmmmmm :)");
    }
}