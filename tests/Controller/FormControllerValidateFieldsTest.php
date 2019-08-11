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

class FormControllerValidateFieldsTest extends TestCase
{


    /**
     * @test
     * @dataProvider provideFields
     * @param $inputs
     * @param $expected
     */
    public function formTest($inputs, $expected)
    {
        $_SERVER['REQUEST_METHOD'] = "POST";

        $formController = new FormController($inputs);
        $data = $formController->validate();

        $this->assertEqualsCanonicalizing($expected, $data);

    }

    public function provideFields()
    {
        return [
            'Name blank' => [
                [
                    'name' => "",
                    'phone' => "1234567890",
                    'email' => "test@test.com",
                    'message' => "Hello message field here.",
                    'pot' => ""
                ],
                [
                    'name' => ['result'=> false, 'message' => "Required fields cannot be empty. Please re-submit the form after fixing required fields."],
                    'email' => ['result'=> true, 'message' => "Field Valid", 'value' => "test@test.com"],
                    'phone' => ['result'=> true, 'message' => "Field Valid", 'value' => "1234567890"],
                    'message' => ['result'=> true, 'message' => "Field Valid", 'value' => "Hello message field here."],
                    'pot' => ['name' => 'pot', 'message' => "Valid", 'result'=> true],
                    'failures' => 1

                ]
            ],

            'Email blank' => [
                [
                    'name' => "Adam",
                    'phone' => "1234567890",
                    'email' => "",
                    'message' => "Hello message field here.",
                    'pot' => ""
                ],
                [
                    'name' => ['result'=> true, 'message' => "Field Valid", 'value' => "Adam"],
                    'email' => ['result'=> false, 'message' => "Email address cannot be blank. Please fix and re-submit the contact form."],
                    'phone' => ['result'=> true, 'message' => "Field Valid", 'value' => "1234567890"],
                    'message' => ['result'=> true, 'message' => "Field Valid", 'value' => "Hello message field here."],
                    'pot' => ['name' => 'pot', 'message' => "Valid", 'result'=> true],
                    'failures' => 1

                ]
            ],

            'Email missing @ symbol' => [
                [
                    'name' => "Adam",
                    'phone' => "1234567890",
                    'email' => "test^test.com",
                    'message' => "Hello message field here.",
                    'pot' => ""
                ],
                [
                    'name' => ['result'=> true, 'message' => "Field Valid", 'value' => "Adam"],
                    'email' => ['result'=> false, 'message' => "Incorrect email address format. Please fix and re-submit the contact form."],
                    'phone' => ['result'=> true, 'message' => "Field Valid", 'value' => "1234567890"],
                    'message' => ['result'=> true, 'message' => "Field Valid", 'value' => "Hello message field here."],
                    'pot' => ['name' => 'pot', 'message' => "Valid", 'result'=> true],
                    'failures' => 1

                ]
            ],

            'Email missing dot (.) symbol' => [
                [
                    'name' => "Adam",
                    'phone' => "1234567890",
                    'email' => "test@testcom",
                    'message' => "Hello message field here.",
                    'pot' => ""
                ],
                [
                    'name' => ['result'=> true, 'message' => "Field Valid", 'value' => "Adam"],
                    'email' => ['result'=> false, 'message' => "Incorrect email address format. Please fix and re-submit the contact form."],
                    'phone' => ['result'=> true, 'message' => "Field Valid", 'value' => "1234567890"],
                    'message' => ['result'=> true, 'message' => "Field Valid", 'value' => "Hello message field here."],
                    'pot' => ['name' => 'pot', 'message' => "Valid", 'result'=> true],
                    'failures' => 1
                ]
            ],

            'Email missing domain name extension' => [
                [
                    'name' => "Adam",
                    'phone' => "1234567890",
                    'email' => "test@test.",
                    'message' => "Hello message field here.",
                    'pot' => ""
                ],
                [
                    'name' => ['result'=> true, 'message' => "Field Valid", 'value' => "Adam"],
                    'email' => ['result'=> false, 'message' => "Incorrect email address format. Please fix and re-submit the contact form."],
                    'phone' => ['result'=> true, 'message' => "Field Valid", 'value' => "1234567890"],
                    'message' => ['result'=> true, 'message' => "Field Valid", 'value' => "Hello message field here."],
                    'pot' => ['name' => 'pot', 'message' => "Valid", 'result'=> true],
                    'failures' => 1
                ]
            ],

            'Message missing' => [
                [
                    'name' => "Adam",
                    'phone' => "1234567890",
                    'email' => "test@test.com",
                    'message' => "",
                    'pot' => ""
                ],
                [
                    'name' => ['result'=> true, 'message' => "Field Valid", 'value' => "Adam"],
                    'email' => ['result'=> true, 'message' => "Field Valid", 'value' => "test@test.com"],
                    'phone' => ['result'=> true, 'message' => "Field Valid", 'value' => "1234567890"],
                    'message' => ['result'=> false, 'message' => "Required fields cannot be empty. Please re-submit the form after fixing required fields."],
                    'pot' => ['name' => 'pot', 'message' => "Valid", 'result'=> true],
                    'failures' => 1
                ]
            ],

            'Message too short' => [
                [
                    'name' => "Adam",
                    'phone' => "1234567890",
                    'email' => "test@test.com",
                    'message' => "Hello",
                    'pot' => ""
                ],
                [
                    'name' => ['result'=> true, 'message' => "Field Valid", 'value' => "Adam"],
                    'email' => ['result'=> true, 'message' => "Field Valid", 'value' => "test@test.com"],
                    'phone' => ['result'=> true, 'message' => "Field Valid", 'value' => "1234567890"],
                    'message' => ['result'=> false, 'message' => "Please enter a minimum of 10 characters into the field"],
                    'pot' => ['name' => 'pot', 'message' => "Valid", 'result'=> true],
                    'failures' => 1
                ]
            ],


            'Honeypot has a value' => [
                [
                    'name' => "Adam",
                    'phone' => "1234567890",
                    'email' => "test@test.com",
                    'message' => "Hello from test message.",
                    'pot' => "Honeypot value"
                ],
                [
                    'name' => ['result'=> true, 'message' => "Field Valid", 'value' => "Adam"],
                    'email' => ['result'=> true, 'message' => "Field Valid", 'value' => "test@test.com"],
                    'phone' => ['result'=> true, 'message' => "Field Valid", 'value' => "1234567890"],
                    'message' => ['result'=> true, 'message' => "Field Valid", 'value' => "Hello from test message."],
                    'pot' => ['name' => 'pot', 'message' => "Invalid", 'result'=> false],
                    'failures' => 1
                ]
            ],

            'Too many parameters' => [
                [
                    'name' => "Adam",
                    'phone' => "1234567890",
                    'email' => "test@test.com",
                    'message' => "Hello from test message.",
                    'pot' => "",
                    'extra' => "Extra param"
                ],
                [
                    'name' => ['result'=> true, 'message' => "Field Valid", 'value' => "Adam"],
                    'email' => ['result'=> true, 'message' => "Field Valid", 'value' => "test@test.com"],
                    'phone' => ['result'=> true, 'message' => "Field Valid", 'value' => "1234567890"],
                    'message' => ['result'=> true, 'message' => "Field Valid", 'value' => "Hello from test message."],
                    'pot' => ['name' => 'pot', 'message' => "Invalid", 'result'=> false],
                    'failures' => 1
                ]
            ],

            'Valid Fields' => [
                [
                    'name' => "Adam",
                    'phone' => "1234567890",
                    'email' => "test@test.com",
                    'message' => "Hello from test message.",
                    'pot' => ""
                ],
                [
                    'name' => ['result'=> true, 'message' => "Field Valid", 'value' => "Adam"],
                    'email' => ['result'=> true, 'message' => "Field Valid", 'value' => "test@test.com"],
                    'phone' => ['result'=> true, 'message' => "Field Valid", 'value' => "1234567890"],
                    'message' => ['result'=> true, 'message' => "Field Valid", 'value' => "Hello from test message."],
                    'pot' => ['name' => 'pot', 'message' => "Valid", 'result'=> true],
                    'failures' => 0
                ]
            ],
        ];
    }
}