<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//para que pueda cargar todas las dependencias.
//require '../library/vendor/autoload.php';
//require __DIR__ . '/../library/vendor/autoload.php';
require __DIR__ . '/../library/vendor/autoload.php';

class Email {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);

        try {
            $this->mail->isSMTP();
            $this->mail->Host       = 'smtp.gmail.com';
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = 'programacionprogra81@gmail.com';
            $this->mail->Password   = 'bhcqvtbksnnhsfuj';
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $this->mail->Port       = 465;

            $this->mail->setFrom('programacionprogra81@gmail.com', 'Sheyla');
            $this->mail->isHTML(true);
        } catch (Exception $e) {
            echo "Error configuring PHPMailer: {$e->getMessage()}";
        }
    }

    public function send($to, $toName, $subject, $body) {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($to, $toName);

            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            $this->mail->send();
            echo "Message has been sent successfully.";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}

