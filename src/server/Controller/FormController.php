<?php

namespace App\Controller;

/**
 * Class FormController
 * Handles validation and sanitation of data from form

 * @package App\Controller
 */
class FormController
{
    private $_formData;
    private $_nameSanitized;
    private $_phoneSanitized;
    private $_emailSanitized;
    private $_messageSanitized;
    private $_validatedData;
    private $_pot;

    public function __construct($formData)
    {
        $this->_formData         = $formData;
        $this->_nameSanitized    = $this->_validateString($this->_formData['name'], false);
        $this->_phoneSanitized   = $this->_validateString($this->_formData['phone'], true);
        $this->_emailSanitized   = $this->_validateEmail($this->_formData['email']);
        $this->_messageSanitized = $this->_validateString($this->_formData['message'], false, 10);
    }

    /**
     * main validation for string based form fields
     *
     * @param string $string text to validate and sanitize
     * @param bool $optional
     * @param int $length minimum length of string
     * @return array
     */
    protected function _validateString($string, $optional = true, $length = 1)
    {
        if ($optional) {
            $val = (empty($string) ? "none" : filter_var($string, FILTER_SANITIZE_STRING));
            return array(
                'result' => true,
                'message' => 'Field Valid',
                'value'   => $val
            );
        }

        if (empty($string)) {
            // send error for required field that is empty
            return array(
                'result' => false,
                'message' => "Required fields cannot be empty. Please re-submit the form after fixing required fields."
            );
        }

        if (strlen($string) < $length) {
            // send error for required field that is empty
            return array(
                'result' => false,
                'message' => "Please enter a minimum of {$length} characters into the field"
            );
        }

        if (filter_var($string, FILTER_SANITIZE_STRING) && !empty($string)) {
            // sanitize text and set as valid
            return array(
                'result' => true,
                'message' => 'Field Valid',
                'value'   => filter_var($string, FILTER_SANITIZE_STRING)
            );
        }
    }

    /**
     * validate email so that malformed data isn't accepted
     * @param $email - email address string
     * @return array
     */
    protected function _validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($email)) {
            return array(
                'result' => true,
                'message' => "Field Valid",
                'value'   => filter_var($email, FILTER_VALIDATE_EMAIL)
            );
        }

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

    /**
     *  validates honeypot to see if it has a value
     */
    protected function _validateHoneypot()
    {
        // check for honeypot value to avoid spam bot entries
        if ($_SERVER['REQUEST_METHOD']==='POST' && empty($this->_formData['pot'])) {
            $this->_pot = ['name' => "pot", 'message' => "Valid", 'result' => true];
        } else {
            $this->_pot = ['name' => "pot", 'message' => "Invalid", 'result' => false];
        }
    }

    /**
     * make sure form isn't passed too many params
     */
    protected function _validateParamQty()
    {
        if (count($this->_formData) > 5) {
            $this->_pot = ['name' => "pot", 'message' => "Invalid", "result" => false];
        }
    }

    /**
     * @param $valData - response data with validation results
     * @return mixed - response with a failures property
     */
    private function _countFailures($valData)
    {
        $fails = 0;
        $valObj = (object) $valData;
        foreach ($valObj as $obj) {
            if ($obj['result'] === false) {
                $fails++;
            }
        }
        $valData['failures'] =  $fails;
        return $valData;
    }

    /**
     * stripping out values form the response so that no potential malicious
     * code could get sent back to browser to execute... just to be safe
     * (even though validation and sanitation already happen)
     *
     * @param $valData - response data with validation results
     * @return mixed - response object ready to be sent to client
     */
    public function cleanData($valData)
    {
        foreach ($valData as $key => $item) {
            unset($valData[$key]['value']);
        }
        return $valData;
    }

    /**
     * main method that executes all validations
     *
     * @return mixed - final object for response
     */
    public function validate()
    {
        $this->_validateHoneypot();
        $this->_validateParamQty();

        $valData = array(
            'name'     => $this->_nameSanitized,
            'email'    => $this->_emailSanitized,
            'phone'    => $this->_phoneSanitized,
            'message'  => $this->_messageSanitized,
            'pot'      => $this->_pot,
        );

        $this->_validatedData = $this->_countFailures($valData);

        return $this->_validatedData;
    }
}
