<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//para que pueda cargar todas las dependencias
require __DIR__ . '/../library/vendor/autoload.php';

class Email {
    private $mail;

    /*Este bloque configura la instancia de PHPMailer 
    para enviar correos electrónicos usando Gmail como 
    servidor SMTP, asegurando que se utilice conexión segura SSL
     y autenticación con usuario y contraseña. */

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

    /*Este método permite enviar un correo electrónico 
    a un destinatario específico usando la instancia de PHPMailer previamente configurada.*/ 
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

