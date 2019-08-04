<?php
namespace App\Form\Validator;
class Validator {
  private $formData;
  private $nameSanitized;
  private $phoneSanitized;
  private $emailSanitized;
  private $messageSanitized;
  private $validatedData;
  private $pot;

  private function validateString($string, $optional = true) {
    if( $optional ) {
      $val = ( empty($string) ? "none" : filter_var($string, FILTER_SANITIZE_STRING) );
      return array(
        'result' => true,
        'message' => 'Field Valid',
        'value'   => $val
      );
    } else {
      if (!filter_var($string, FILTER_SANITIZE_STRING) === false && empty($string) !== true) {
        // sanitize text
        return array(
          'result' => true,
          'message' => 'Field Valid',
          'value'   => filter_var($string, FILTER_SANITIZE_STRING)
        );
      } else {
        // send error for required field that is empty
        return array(
          'result' => false,
          'message' => "Required fields cannot be empty. Please re-submit the form after fixing required fields."
        );
      }
    }
  }

  function validateEmail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false && empty($email) !== true) {
      return array(
        'result' => true,
        'message' => "Field Valid",
        'value'   => filter_var($email, FILTER_VALIDATE_EMAIL)
      );
    } else {
      if (empty($email) === true) {
        return array(
          'result' => false,
          'message' => "Email address cannot be blank. Please fix and re-submit the contact form."
        );
      }
      return array(
        'result' => false,
        'message' => "Incorrect email address format. Please fix and re-submit the contact form."
      );
    }
  }

  private function countFailures($valData){
    $fails = 0;
    $count = count($valData);
    $valObj = (object) $valData;
    // var_dump($valObj);

    foreach ($valObj as $prop) {
      if($prop['result'] === false){
        $fails++;
      }
    }
    $valData['failures'] =  $fails;
    return $valData;
  }

  public function run() {
    $this->formData         = json_decode(file_get_contents("php://input"), TRUE);
    $this->nameSanitized    = $this->validateString($this->formData['name'], false);
    $this->phoneSanitized   = $this->validateString($this->formData['phone'], true);
    $this->emailSanitized   = $this->validateEmail($this->formData['email']);
    $this->messageSanitized = $this->validateString($this->formData['message'], false);

    // check for honeypot value to avoid spam bot entries
    if($_SERVER['REQUEST_METHOD']==='POST' && empty($this->formData['pot']) ) {
      $this->pot              = ['name' => "pot", 'message' => "Valid", 'result' => true];
    } else {
      $this->pot              = ['name' => "pot", 'message' => "Invalid", 'result' => false];
    }

    $valData = array(
      'name'     => $this->nameSanitized,
      'email'    => $this->emailSanitized,
      'phone'    => $this->phoneSanitized,
      'message'  => $this->messageSanitized,
      'pot'      => $this->pot,
    );

    $this->validatedData = $this->countFailures($valData);

    // return isset($_POST['pot']);
    return $this->validatedData;
  }
}