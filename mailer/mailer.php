

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/PHPMailer.php";
require "PHPMailer/SMTP.php";
require "PHPMailer/Exception.php";

// Instantiation and passing `true` enables exceptions

function SendMail($email,$id){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = '';                     // SMTP username
            $mail->Password   = '';                               // SMTP password
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('insea.inscription.site@gmail.com', 'Insea Inscription 2021');
            $mail->addAddress($email, 'User');  
            $target = "http://localhost/tests/insea-proget/index?action=confirm&id_confirme=".$id;
            require "template.php";   // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = "Inscription à insea pour l'année 2021-".$id;
            $target = "http://localhost/tests/insea-proget/index?action=confirm&id_confirme=".$id;
            $mail->Body    = $message;
            $mail->CharSet = 'UTF-8'; 
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            //----------------------------------SMTP ERROR:
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                ));
            
            $mail->send();
            //echo 'Message has been sent';
            return true;
        } catch (Exception $e) {
            return false;
            //{$mail->ErrorInfo}";
        }
}



