<?php
define ('PROJECT_DIR', dirname(__FILE__, 2) );
require PROJECT_DIR . "/vendor/autoload.php";


use \Rollbar\Rollbar;
use \Rollbar\Payload\Level;

use App\Form\Validator\Validator;
use App\Database\FormEntry\FormEntry;

// load environment variable bc security
$dotenv = Dotenv\Dotenv::create(PROJECT_DIR);
$dotenv->load();

// Rollbar::init(
//     array(
//         'access_token' => getenv('ROLLBAR_TOKEN'),
//         'environment' => getenv('ROLLBAR_MODE')
//     )
// );

// Rollbar::log(Level::info(), 'Test info message');
// throw new Exception('Test exception');

$formEntry = new FormEntry();

$validator = new Validator();
$result = $validator->run();

echo $formEntry->run($result);