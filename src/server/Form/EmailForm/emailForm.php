<?php
namespace App\Form\EmailForm;
class SendEmail {
private $address = "moose62712@gmail.com";
private $body = "No Body";
private $subject = "No Subject";

public function send() {

  mail($this->address, $this->body, $this->subject );

}
}