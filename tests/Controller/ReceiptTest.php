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

    /** @test */
    public function testTotal()
    {
        $inputItems = [1, 2, 3, 4, 5];
        $coupon = null;
        $output = $this->receipt->total($inputItems, $coupon);
        $this->assertEquals(
            15,
            $output,
            "Total should equal 1.00"
        );
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

    public function testPostTaxTotal() {
        $receipt = $this->getMockBuilder('App\Controller\Receipt')
            ->setMethods(['tax', 'total'])
            ->getMock();
        $receipt->method('total')
            ->will($this->returnValue(10.00));
        $receipt->method('tax')
            ->will($this->returnValue(1.00));
        $result = $receipt->postTaxTotal([1, 2], 0.20, null);
        $this->assertEquals(11.00, $result);
    }
}

