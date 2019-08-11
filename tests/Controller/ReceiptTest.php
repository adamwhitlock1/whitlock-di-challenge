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
    public function testTax()
    {
        $inputAmount = 10.00;
        $inputTax = .10;
        $output = $this->receipt->tax($inputAmount, $inputTax);
        $this->assertEquals(
            1.00,
            $output,
            "Tax calculate should equal 1.00"
        );
    }
}

