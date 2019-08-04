<?php
namespace App\Form\EmailForm;

class SendEmail {
  private $address;
  private $headers;
  private $body;
  private $subject;

  public function __construct($address="moose62712@gmail.com", $headers = "From: noemail@default.com", $body = "No Body", $subject = "No Subject")
  {
    $this->address = $address;
    $this->headers = $headers;
    $this->body = $body;
    $this->subject = $subject;
  }

  public function setHeaders($headers)
  {
    $this->headers = $headers;
  }

  public function setSubject($subject)
  {
    $this->subject = $subject;
  }

  public function setBody($name, $message, $phone = "none")
  {
    $this->body = "Name: {$name}\r\nPhone: {$phone}\r\n\r\nMessage:\r\n{$message}";
  }

  public function send()
  {
    try {
      mail($this->address, $this->subject, $this->body, $this->headers);
    } catch (\Throwable $th) {
      throw $th;
    }

  }
}