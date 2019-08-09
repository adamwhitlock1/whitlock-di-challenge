<?php
/**
 * Created by PhpStorm.
 * User: adamwhitlock
 * Date: 8/7/19
 * Time: 7:49 PM
 */

namespace App\Test;

use App\Controller\FormController;
use PHPUnit\Framework\TestCase;

class FormControllerEmailTest extends TestCase
{
    /** @test */
    public function emailWithNoAtSymbol()
    {
        $_SERVER['REQUEST_METHOD'] = "POST";
        $formData = array(
            'name' => "Test Name",
            'phone' => "1234567890",
            'email' => "billy*stuff.com",
            'message' => "Test Message"
        );
        $formController = new FormController($formData);
        $data = $formController->validate();

        $failures = $data['failures'];

        $this->assertEquals(1, $failures, "Single Failure for no @");
        $this->assertFalse($data['email']['result'], "Email result is false");
    }

    /** @test */
    public function emailWithNoDot()
    {
        $_SERVER['REQUEST_METHOD'] = "POST";
        $formData = array(
            'name' => "Test Name",
            'phone' => "1234567890",
            'email' => "billy@stuffcom",
            'message' => "Test Message"
        );
        $formController = new FormController($formData);
        $data = $formController->validate();

        $failures = $data['failures'];

        $this->assertEquals(1, $failures, "Single Failure for no .extension");
        $this->assertFalse($data['email']['result'], "Email result is false");
    }

    /** @test */
    public function emailNoDomain()
    {
        $_SERVER['REQUEST_METHOD'] = "POST";
        $formData = array(
            'name' => "Test Name",
            'phone' => "1234567890",
            'email' => "billy@test.",
            'message' => "Test Message"
        );
        $formController = new FormController($formData);
        $data = $formController->validate();
        print_r($data['email']['result']);
        $failures = $data['failures'];

        $this->assertEquals(1, $failures, "Single Failure for no domain extension");
        $this->assertFalse($data['email']['result'], "Email result is false");
    }

    /** @test */
    public function emailEmpty()
    {
        $_SERVER['REQUEST_METHOD'] = "POST";
        $formData = array(
            'name' => "Test Name",
            'phone' => "1234567890",
            'email' => "",
            'message' => "Test Message"
        );
        $formController = new FormController($formData);
        $data = $formController->validate();
        print_r($data['email']['result']);

        $failures = $data['failures'];

        $this->assertEquals(1, $failures, "Single Failure for empty email");
        $this->assertFalse($data['email']['result'], "Email result is false");
    }
}
