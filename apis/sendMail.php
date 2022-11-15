<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../src/Exception.php';
require '../src/PHPMailer.php';
require '../src/SMTP.php';
trait sendMail {
    function mailSender($to,$subject,$mbody,$via){
        $mail = new PHPMailer(true);
    
        try {
            $mail->SMTPDebug = 2;                                       
            $mail->isSMTP();                                            
            $mail->Host       = 'mail.greenhillvest.com';                    
            $mail->SMTPAuth   = true;                             
            $mail->Username   = $via;                
            $mail->Password   = '0901269cj';                        
            $mail->SMTPSecure = 'tls';                              
            $mail->Port       = 587;  
          
            $mail->setFrom($via, 'Greenhillvest');           
            $mail->addAddress($to);
            // $mail->addAddress('receiver2@gfg.com', 'Name');
              
            $mail->isHTML(true);                                  
            $mail->Subject = $subject;
            $mail->Body    = $mbody;
            $mail->AltBody = 'this is incase the html does not work';
            $mail->send();
            //echo $sucessmsg;
            return 'success';
        } catch (Exception $e) {
            return 'fail';
            //echo "$failmsg : $mail->ErrorInfo";
        }
      } 
}