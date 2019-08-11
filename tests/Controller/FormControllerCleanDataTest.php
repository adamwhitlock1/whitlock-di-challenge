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

class FormControllerCleanDataTest extends TestCase
{

    /**
     * @test
     * @dataProvider provideData
     * @param $inputs
     * @param $expected
     */
    public function cleanDataTest($inputs, $expected)
    {
        $_SERVER['REQUEST_METHOD'] = "POST";

        $formController = new FormController($inputs);
        $valData = $formController->validate();
        $data = $formController->cleanData($valData);

        $this->assertEqualsCanonicalizing($expected, $data);

    }

    public function provideData()
    {
        return [
            'Strips all fields of their values for return response' => [
                [
                    'name' => "Adam",
                    'phone' => "1234567890",
                    'email' => "test@test.com",
                    'message' => "Hello from test message.",
                    'pot' => ""
                ],
                [
                    'name' => ['result'=> true, 'message' => "Field Valid"],
                    'email' => ['result'=> true, 'message' => "Field Valid"],
                    'phone' => ['result'=> true, 'message' => "Field Valid"],
                    'message' => ['result'=> true, 'message' => "Field Valid"],
                    'pot' => ['name' => 'pot', 'message' => "Valid", 'result'=> true],
                    'failures' => 0

                ]
            ],
        ];

    }
}