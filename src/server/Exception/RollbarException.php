<?php
namespace App\Exception;

use Exception;
use \Rollbar\Rollbar;
use \Rollbar\Payload\Level;

// use App\Database\FormEntry\FormEntry;


class RollbarException {
    public function __construct()
    {
        Rollbar::init(
            array(
                'access_token' => getenv('ROLLBAR_TOKEN'),
                'environment' => getenv('ROLLBAR_MODE')
            )
        );
    }



    public function logError($error){
        Rollbar::log(Level::error(), $error);
    }

    public function logInfo($info){
        Rollbar::log(Level::error(), $info);
    }
}