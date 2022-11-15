<?php
require_once 'sendMail.php';
$response = array();
class send_contact{
    use sendMail;
    private $subject;
    private $email;
    private $msg;

    public function send_email($sub,$em,$msge){
        global $response;
        $this->subject = $sub;
        $this->email = $em;
        $this->msg = $msge;
        $body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Contact Email</title>
        </head>
        <body>
        <div>
                Email : '.$this->email.' <br>
                Message: '.$this->msg. '
        </div>
        </body>
        </html>
        ';
        // $sendit = $this->mailSender('info@ominecoinltd.com',$this->subject,$body,'no-reply@ominecoinltd.com');
        // if($sendit == 'success'){
        //     $response['err_code'] = 0;
        //     $response['error'] = false;
        //     $response['message'] = 'message sent';
        // }else{

        //     $response['error'] = true;
        //     $response['err_code'] = 2;
        //     $response['message'] = 'message not sent';
        // }
        $response['err_code'] = 0;
        $response['error'] = false;
        $response['message'] = 'message sent';
    }
}
if(isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message2'])){
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message2 = $_POST['message2'];
    $try = new send_contact;
    $try->send_email($subject,$email,$message2);
}else{
        $response['error'] = true;
        $response['err_code'] = 1;
        $response['message'] = 'stuffs not set';
}

echo json_encode($response);