<?php
/**
 * Created by PhpStorm.
 * User: adamwhitlock
 * Date: 8/6/19
 * Time: 1:58 AM
 */

namespace App\Test;

use \PHPUnit\Framework\TestCase;

use App\Model\Email;

class EmailTest extends TestCase
{
    public function setUp(): void
    {
        $this->email = new Email();
    }

    public function tearDown(): void
    {
        unset($this->email);
    }

    /** @test */
    public function testSending()
    {
        $result = $this->email->sendMail('test@test.com', 'Name From PHPunit', '1234567890');
        $this->assertTrue(
            $result,
            "Test mail function returning true");
    }
}