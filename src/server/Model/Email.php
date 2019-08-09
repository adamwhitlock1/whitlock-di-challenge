<?php
namespace App\Model;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    private $_mail;
    private $_to;
    private $_subject;
    private $_mailContent;
    private $_from;

    public function __construct()
    {
        $this->_mail = new PHPMailer();
        $this->_mail->isSMTP();
        $this->_mail->Host = getenv('MAIL_HOST');
        $this->_mail->Username = getenv('MAIL_USERNAME');
        $this->_mail->Password = getenv('MAIL_PASSWORD');
        $this->_mail->SMTPAuth = true;
        $this->_mail->SMTPSecure = 'tls';
        $this->_mail->Port = getenv('MAIL_PORT');
        $this->_to = getenv('MAIL_TO_ADDRESS');
        $this->_subject = "New Form Submission From Contact Form";
    }

    public function setFrom($from){
        $this->_from = $from;
    }

    public function setSubject(string $value){
        $this->_subject = $value;
        return $this->_subject;
    }

    public function sendMail($from, $name, $message, $phone = "none")
    {
        $this->_mail->setFrom($from);
        $this->_mail->addAddress('adam.whitlock627@gmail.com', 'Guy Smiley');
        $this->_mail->Subject = $this->_subject;
        $this->_mail->isHTML(true);
        $this->_mailContent = "<h1>Contact form submission details:</h1>
        <p>Name: {$name}</p>
        <p>Phone: {$phone}</p>
        <p>Message:</p>
        <p>{$message}</p>";
        $this->_mail->Body = $this->_mailContent;

        try {
            $this->_mail->send();
            return true;
        } catch (\Exception $e) {
            return "error: " . $e->getMessage();
        }



    }
}