<?php
namespace App\Model;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Sending out email via php mailer and mail trap service
 *
 * Class Email
 * @package App\Model
 */
class Email
{
    private $_mail;
    private $_to;
    private $_subject;
    private $_mailContent;

    /**
     * Email constructor.
     * sets up main php mailer config and loads env vars
     */
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

    /**
     * @param string $from - from email address
     * @param string $name - name of sender
     * @param string $message - main message from form
     * @param string $phone - phone number
     * @return bool|string - result of sending email
     */
    public function sendMail($from, $name, $message, $phone = "none")
    {
        try {
            $this->_mail->setFrom($from);
        } catch (\PHPMailer\PHPMailer\Exception $e) {
            return "error: " . $e->getMessage();
        }
        $this->_mail->addAddress('guy-smiley@example.com', 'Guy Smiley');
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
        } catch (Exception $e) {
            return "error: " . $e->getMessage();
        }



    }
}