<?php
define('PROJECT_DIR', dirname(__FILE__, 2));
require PROJECT_DIR . "/vendor/autoload.php";

use App\Controller;
use App\Model\Email;
use App\Model\FormEntry;
use App\Exception;

$env = Dotenv\Dotenv::create(PROJECT_DIR);
$env->load();


$formData = json_decode(file_get_contents("php://input"), TRUE);

$formController = new Controller\FormController($formData);
$data = $formController->validate();
$formEntry = new FormEntry();

if ($data['failures'] === 0) {
    $email = new Email();
    $email_res = $email->sendMail($data['email']['value'], $data['name']['value'], $data['message']['value'], $data['phone']['value']);
    $data['email_result'] = $email_res;
    if ($email_res === true) {
        $response = $formEntry->run($data);
        echo json_encode($formController->cleanData($response));
        return;
    }
}

echo json_encode($data);
return;