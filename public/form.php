<?php
define ('PROJECT_DIR', dirname(__FILE__, 2) );
require PROJECT_DIR . "/vendor/autoload.php";

use App\Form\Validator\Validator as Validator;
use App\Database\FormEntry\FormEntry as FormEntry;

$formEntry = new FormEntry();

$validator = new Validator();
$result = $validator->run();

echo $formEntry->run($result);


// $dotenv = Dotenv\Dotenv::create($project_dir);
// $dotenv->load();