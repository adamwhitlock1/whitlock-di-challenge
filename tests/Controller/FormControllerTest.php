<?php
/**
 * Created by PhpStorm.
 * User: adamwhitlock
 * Date: 8/7/19
 * Time: 8:35 PM
 */

namespace App\Test;

use App\Controller\FormController;
use PHPUnit\Framework\TestCase;

class FormControllerTest extends TestCase
{
    /** @test */
    public function allValid()
    {
        $_SERVER['REQUEST_METHOD'] = "POST";
        $formData = array(
            'name' => "Test Name",
            'phone' => "1234567890",
            'email' => "test@test.com",
            'message' => "Test Message"
        );
        $formController = new FormController($formData);
        $data = $formController->validate();

        $failures = $data['failures'];

        $this->assertEquals(0, $failures, "All Fields Valid");
        $this->assertTrue($data['name']['result'], "Name true");
        $this->assertTrue($data['phone']['result'], "Phone true");
        $this->assertTrue($data['email']['result'], "Email true");
        $this->assertTrue($data['message']['result'], "Message true");
        $this->assertTrue($data['pot']['result'], "Honeypot true");
    }

    /** @test */
    public function allInvalid()
    {
        $_SERVER['REQUEST_METHOD'] = "POST";
        $formData = array(
            'name' => "",
            'phone' => "",
            'email' => "",
            'message' => "",
            'pot' => "pot value"
        );
        $formController = new FormController($formData);
        $data = $formController->validate();

        $failures = $data['failures'];

        $this->assertEquals(4, $failures, "All Fields Valid");
        $this->assertFalse($data['name']['result'], "Name false");
        $this->assertTrue($data['phone']['result'], "Phone would always be true");
        $this->assertFalse($data['email']['result'], "Email false");
        $this->assertFalse($data['message']['result'], "Message false");
        $this->assertFalse($data['pot']['result'], "Honeypot false");
    }

    /** @test */
    public function tooManyParameters()
    {
        $_SERVER['REQUEST_METHOD'] = "POST";
        $formData = array(
            'name' => "Adam",
            'phone' => "1234567890",
            'email' => "test@test.com",
            'message' => "Hello this is a message.",
            'pot' => "",
            'extra' => "yes"
        );
        $formController = new FormController($formData);
        $data = $formController->validate();

        $failures = $data['failures'];

        $this->assertEquals(1, $failures, "All Fields Valid");
        $this->assertFalse($data['pot']['result'], "Honeypot false bc too many params given");

    }

    /** @test */
    public function tooSmallMessageLength()
    {
        $_SERVER['REQUEST_METHOD'] = "POST";
        $formData = array(
            'name' => "Adam",
            'phone' => "1234567890",
            'email' => "test@test.com",
            'message' => "Hello",
            'pot' => "",
        );
        $formController = new FormController($formData);
        $data = $formController->validate();

        $failures = $data['failures'];

        $this->assertEquals(1, $failures, "Single failure for short message");
        $this->assertFalse($data['message']['result'], "Message false bc too short");

    }
}