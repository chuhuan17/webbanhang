<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'mail/PHPMailer-master/src/Exception.php';
include 'mail/PHPMailer-master/src/PHPMailer.php';
include 'mail/PHPMailer-master/src/SMTP.php';

class Mailer {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->CharSet = 'UTF-8';
    }

    public function dathanggmail($tieude,$noidung,$maildathang) {
        try {
            //Server settings
            $this->mail->isSMTP();                                            //Send using SMTP
            $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $this->mail->Username   = 'chwhuan17@gmail.com';                  //SMTP username
            $this->mail->Password   = 'zjfc zpuh ipcq enxu';                  //SMTP password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $this->mail->Port       = 465;                                    //TCP port to connect to

            //Recipients
            $this->mail->setFrom('chwhuan17@gmail.com', 'Mailer');
            $this->mail->addAddress($maildathang);          //Add a recipient

            //Content
            $this->mail->isHTML(true);                                       //Set email format to HTML
            $this->mail->Subject = $tieude;
            $this->mail->Body    = $noidung;

            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}

// Sử dụng lớp

?>
