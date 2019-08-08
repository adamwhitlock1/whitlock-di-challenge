<?php
/**
 * Created by PhpStorm.
 * User: adamwhitlock
 * Date: 8/6/19
 * Time: 3:07 AM
 */
use PHPUnit\Framework\TestCase;

class TestTest extends TestCase
{
    public function testPushAndPop()
    {
        $stack = [];
        $this->assertEquals(0, count($stack));

        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertEquals(1, count($stack));

        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    }
}
?>