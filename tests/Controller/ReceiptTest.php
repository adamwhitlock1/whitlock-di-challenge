<?php
/**
 * Created by PhpStorm.
 * User: adamwhitlock
 * Date: 8/7/19
 * Time: 7:49 PM
 */

namespace App\Test;

use App\Controller\Receipt;
use PHPUnit\Framework\TestCase;

class ReceiptTest extends TestCase
{

    protected function setUp(): void
{
    $this->receipt = new Receipt();
}

protected function tearDown(): void
{
    unset($this->receipt);
}

    /**
     * @test
     * @dataProvider provideTotal
     * @param $items
     * @param $expected
     */
    public function testTotal($items, $expected)
    {
        $coupon = null;
        $output = $this->receipt->total($items, $coupon);
        $this->assertEquals(
            $expected,
            $output,
            "Total should equal {$expected}"
        );
    }

    public function provideTotal(){
        return [
            'total equal 16' => [[1, 2, 5, 8], 16],
            [[-1, 2, 5, 8], 14],
            [[1, 2, 8], 11]
        ];
    }


    /** @test */
    public function testTotalAndCoupon()
    {
        $inputItems = [1, 2, 3, 4, 5];
        $coupon = 0.20;
        $output = $this->receipt->total($inputItems, $coupon);
        $this->assertEquals(
            12,
            $output,
            "Total should equal 1.00"
        );
    }

    /** @test */
    public function testTotalException()
    {
        $inputItems = [1, 2, 3, 4, 5];
        $coupon = 1.20;
        $this->expectException('BadMethodCallException');
        $this->receipt->total($inputItems, $coupon);
    }

    /** @test */
    public function testTax()
    {
        $inputAmount = 10.00;
        $inputTax = .10;
        $output = $this->receipt->tax($inputAmount, $inputTax);
        // echo " ". $output . " ";
        $this->assertEquals(
            1.00,
            $output,
            "Tax calculate should equal 1.00"
        );
    }

    /** @test */
    public function testPostTaxTotal() {
        $items = [1, 2, 5, 8];
        $tax = 0.20;
        $coupon = null;

        $receipt = $this->getMockBuilder('App\Controller\Receipt')
            ->setMethods(['tax', 'total'])
            ->getMock();

        $receipt->expects($this->once())
            ->method('total')
            ->with($items, $coupon)
            ->will($this->returnValue(10.00));

        $receipt->expects($this->once())
            ->method('tax')
            ->with(10.00, $tax)
            ->will($this->returnValue(1.00));

        $result = $receipt->postTaxTotal([1, 2, 5, 8], 0.20, null);

        $this->assertEquals(11.00, $result);

    }
}

