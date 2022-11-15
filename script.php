<?php
 //require_once 'vendor/autoload.php';
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

 require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use CoinGate\CoinGate;

class topspin{
 public $dbuser,$dbpassword,$dbname,$dbhost,$conn;
    
    function dbcon(){
      $this->dbhost = "localhost";
       $this->dbuser = "root";
       $this->dbpassword = "";
       $this->dbname = "bitinvest";
       $this->conn = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpassword,$this->dbname);
       if(!$this->conn){
           echo " database connection error ";
        }


    }


   function mailSender($to,$subject,$mbody,$via){
      $mail = new PHPMailer(true);
  
      try {
          $mail->SMTPDebug = 0;                                       
          $mail->isSMTP();                                            
          $mail->Host       = 'mail.ominecoinltd.com';                    
          $mail->SMTPAuth   = true;                             
          $mail->Username   = $via;                
          $mail->Password   = '0901269cj';                        
          $mail->SMTPSecure = 'tls';                              
          $mail->Port       = 587;  
        
          $mail->setFrom($via, 'Ominecoin Limited');           
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



    function signup(){
      $ref = "";
      if (isset($_POST["signup"])) {
      $un = mysqli_real_escape_string($this->conn, trim($_POST['username']));  
      $fn = mysqli_real_escape_string($this->conn, trim($_POST['fullname']));  
      $em = mysqli_real_escape_string($this->conn, trim($_POST['em']));
      $pass = mysqli_real_escape_string($this->conn, trim($_POST['pass']));
      $conpass = mysqli_real_escape_string($this->conn, trim($_POST['conpass']));
      $method = mysqli_real_escape_string($this->conn, trim($_POST['method']));
      switch ($method) {
        case 'bitcoin':
          $btc = mysqli_real_escape_string($this->conn, trim($_POST["wallet"]));
          $ether = "Not Added";
          $usdt = "Not Added";
          $pfm = "Not Added";
          $btrans = "Not Added";
          break;
        case 'ethereum':
          $ether = mysqli_real_escape_string($this->conn, trim($_POST["wallet"]));
          $btc = "Not Added";
          $usdt = "Not Added";
          $pfm = "Not Added";
          $btrans = "Not Added";
          break;
        // case 'usdt':
        //   $usdt = mysqli_real_escape_string($this->conn, trim($_POST["wallet"]));
        //   $btc = "Not Added";
        //   $ether = "Not Added";
        //   $pfm = "Not Added";
        //   $btrans = "Not Added";
        //   break;
        // case 'usd':
        //   $usdt = mysqli_real_escape_string($this->conn, trim($_POST["wallet"]));
        //   $btc = "Not Added";
        //   $ether = "Not Added";
        //   $pfm = "Not Added";
        //   $btrans = "Not Added";
        //   break;
        //   case 'btrans':
        //     $btrans = mysqli_real_escape_string($this->conn, trim($_POST["wallet"]));
        //     $btc = "Not Added";
        //     $ether = "Not Added";
        //     $pfm = "Not Added";
        //     $usdt = "Not Added";
        //     break;
        default:
        $btc = "Not Added";
        $ether = "Not Added";
        // $pfm = "Not Added";
        // $btrans = "Not Added";
        // $usdt = "Not Added";
      }
      $ph = "Not Added";
      $error = array();
 
      //check if password matches
      if($pass !== $conpass){
        $error[] = "password does not match";
      }

      //check if username exists
      $checkq = " SELECT * FROM `customer` WHERE  `u_name` = '$un' ";
      $process4 = mysqli_query($this->conn , $checkq);
      if( mysqli_num_rows($process4) == 1 ) {
          $error[] = " Username has already been taken by another customer ";
      }

      // check for email
      $checkq2 = " SELECT * FROM `customer` WHERE  `email` = '$em' ";
      $process2 = mysqli_query($this->conn , $checkq2);
      if( mysqli_num_rows($process2) == 1 ) { 
          $error[] = " Email already exist ";
      }
      //check if ref exists
      if (!isset($_GET["id"]) || empty($_GET["id"])) {
        $ref = "cup";
      }else{
        $ref = mysqli_real_escape_string($this->conn, trim($_GET['id'])); 
        $checkq3 = " SELECT * FROM `customer` WHERE  `u_name` = '$ref' ";
        $process3 = mysqli_query($this->conn , $checkq3);
          if( mysqli_num_rows($process3) == 1 ) { 
            $row3 = mysqli_fetch_assoc($process3);
            $you = $row3["u_name"];
            $whom = $row3["email"];
            $topic = "New Direct Signup for you";
            $bdy = '
              <!DOCTYPE html>
              <html>
              <head>
                  <title>Account confirmation mail</title>
                  <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
              </head>

              <body style="padding: 40px; background-color: rgb(237, 236, 236); font-family:Cabin,sans-serif;">

                  <div style="color: #fff; text-align: center; padding-bottom: 20px;">
                      <img src="https://' . $_SERVER['HTTP_HOST'] . '/images/logo.png" alt="Ominecoin Limited">
                  </div>
              <div style="background: #fff; padding: 30px;">
                  <h3>Dear  (' . $you . ') , </h3>
                  <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                  you have a new direct signup on Ominecoin Limited details below</p>

                  <div style="margin-top: 10px;">
                      <table style="width: 100%; border-collapse: collapse; width: 100%; border: none; text-align: left;">
                          <tr style="border: 1px solid rgb(240, 240, 240); text-align: left;">
                              <td style="padding: 15px;">Username</td>
                              <td style="padding: 15px;">' . $un . '</td>
                          </tr>
                          <tr style="border: 1px solid #ddd; text-align: left;">
                               <td style="padding: 15px;">Full name</td>
                                <td style="padding: 15px;">' . $fn . '</td>
                          </tr>

                          <tr style="border: 1px solid #ddd; text-align: left;">
                              <td style="padding: 15px;">Email</td>
                              <td style="padding: 15px;">' . $em . '</td>
                          </tr>
                          <tr style="border: 1px solid #ddd; text-align: left;">
                               <td style="padding: 15px;">Mobile number</td>
                                <td style="padding: 15px;">' . $ph . '</td>
                          </tr>
                         
                      </table>
                  </div>
                  <hr style="margin-top: 75px; border: none; height: 2px; background-color:rgb(255, 194, 62);">
                  <div style="padding: 2px 20px 20px 20px;">
                      <p>Dear valued customer, <b>Ominecoin Limited</b> will never ask for your account Id during withdrawal </p>
                      <p style="text-align: justify;">We are a company that strives to stay
                          in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can
                          offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and
                          automated payment processing has enabled us to find ways to offer more to our clients. We offers an
                          investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a
                          reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have
                          come as a Bitcoin investment company.</p>
                      <ul>
                          <li> Our offical Email for customer support is <a style="color: #f7923a;"
                                  href="mailto:admin@ominecoinltd.com">mailto:admin@ominecoinltd.com </a> </li>
                          <li> login to dashboard: https://ominecoinltd.com/login </li>
                      </ul>
                  </div>
              </div>

              </body>

              </html>  ';

                $mailz_stat = $this->mailSender($whom,$topic,$bdy,'no-reply@ominecoinltd.com');
                if($mailz_stat === 'success'){
                  echo 'ref email sent';
                }else{
                  echo 'ref email sending failed';
                }
          }else{
            $error[] = " Referal does not exist";
          }
      }
    
 

      $hash = "CUS_".rand(1000000,9000000);   
      
      if (empty($error)) {
          
      $query =" INSERT INTO `customer` (`f_name`, `customer_hash`,`ref`, `u_name`, `email`, `phone`, `refr_id`,`password`, `btc`,`pfm`,`lite`,`ether`,`bank_transfer`,`time`)
       VALUES ('$fn', '$hash','$ref', '$un', '$em', '$ph', 'manu', '$pass', '$btc', '$pfm', '$usdt', '$ether','$btrans',NOW())";
          $process = mysqli_query($this->conn , $query);
          if ($process) {
              
          $sql = mysqli_query($this->conn, "INSERT INTO `refferals` ( `ref`, `user_id`, `ref_date`) VALUES ('$ref', '$un', NOW())");
          if ($sql) {

            $to = $em;
            $subject = "Account has been created successfully ";
            
            $message = '
            <!DOCTYPE html>
            <html>
            <head>
                <title>Account confirmation mail</title>
                <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
            </head>

            <body style="padding: 40px; background-color: rgb(237, 236, 236); font-family:Cabin,sans-serif;">

                <div style="color: #fff; text-align: center; padding-bottom: 20px;">
                    <img src="' . $_SERVER['HTTP_HOST'] . '/images/logo.png" alt="Ominecoin Limited">
                </div>
            <div style="background: #fff; padding: 30px;">
                <h4>Welcome '.$un.', </h4>
                <p style="font-family: sans-serif; font-size: 15px; text-align: justify; height: 100px;">
                    Welcome to Ominecoin Limited network where your cryptocurrencies are invested.Thank you for being part of a
                    fast-growing area of the world investment. Invest cryptocurrency and get heavy returns off upto 50% investment.
                </p>

                <div style="margin-top: 10px;">
                    <table style="width: 100%; border-collapse: collapse; width: 100%; border: none; text-align: left;">
                        <tr style="border: 1px solid rgb(240, 240, 240); text-align: left;">
                            <td style="padding: 15px;">Username</td>
                            <td style="padding: 15px;">'.$un.'</td>
                        </tr>
                        <tr style="border: 1px solid #ddd; text-align: left;">
                            <td style="padding: 15px;">Full name</td>
                            <td style="padding: 15px;">'.$fn.'</td>
                        </tr>

                        <tr style="border: 1px solid #ddd; text-align: left;">
                            <td style="padding: 15px;">Email</td>
                            <td style="padding: 15px;">'.$em.'</td>
                        </tr>
                        <tr style="border: 1px solid #ddd; text-align: left;">
                            <td style="padding: 15px;">Mobile number</td>
                            <td style="padding: 15px;">'.$ph.'</td>
                        </tr>
                        <tr style="border: 1px solid #ddd; text-align: left;">
                            <td style="padding: 15px;">Bitcoin Address</td>
                            <td style="padding: 15px;">'.$btc.'</td>
                        </tr>
                        <tr style="border: 1px solid #ddd; text-align: left;">
                            <td style="padding: 15px;">Perfect Money</td>
                            <td style="padding: 15px;">'.$pfm. '</td>
                        </tr>
                        <tr style="border: 1px solid #ddd; text-align: left;">
                            <td style="padding: 15px;">Usdt Address</td>
                            <td style="padding: 15px;">' . $usdt . '</td>
                        </tr>
                        <tr style="border: 1px solid #ddd; text-align: left;">
                            <td style="padding: 15px;">Etherum Address</td>
                            <td style="padding: 15px;">'.$ether.'</td>
                        </tr>
                    </table>
                </div>
                <hr style="margin-top: 75px; border: none; height: 2px; background-color:rgb(255, 194, 62);">
                <div style="padding: 2px 20px 20px 20px;">
                    <p>Dear valued customer, <b>Ominecoin Limited</b> will never ask for your account Id during withdrawal </p>
                    <p style="text-align: justify;">We are a company that strives to stay
                        in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can
                        offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and
                        automated payment processing has enabled us to find ways to offer more to our clients. We offers an
                        investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a
                        reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have
                        come as a Bitcoin investment company.</p>
                    <ul>
                        <li> Our offical Email for customer support is <a style="color: #f7923a;"
                                href="mailto:admin@ominecoinltd.com">mailto:admin@ominecoinltd.com </a> </li>
                        <li> login to dashboard: https://ominecoinltd.com </li>
                    </ul>
                </div>
            </div>

            </body>

            </html>
            ';
            
            $mailz_status = $this->mailSender($to,$subject,$message,'no-reply@ominecoinltd.com');
            if($mailz_status === 'success'){
              $this->sendEmailVerification($to,$un,$hash);
              echo '
                Congratulation you have registered successfully.
                we have sent an email verification link to you.
                pls verify before login.
                <a href="login" class="btn btn-default"> Proceed </a>
              ';
            }else{
              $this->sendEmailVerification($to, $un, $hash);
              echo '
              Congratulation you have registered successfully.mail not sent
                we have sent an email verification link to you.
                pls verify before login.
              <a href="login" class="btn btn-default"> Proceed to login </a>    
              ';
            }
          
               
            }else {echo mysqli_error($this->conn);}
          }else {echo mysqli_error($this->conn);}
          }else{
          echo ' <h6 style="color:red;"> Sorry the following error occoured </h6>
              <ul class="list-group">
          ';
          $id = count($error);
          //echo $id;
          for ($i=0; $i < $id ; $i++) { 
              echo '<li class="list-group-item list-group-item-danger">'.$error[$i].'</li>';
          }
          echo '</ul>';
              }
          }
        }

      function getreffeduser(){
        $un = $_GET["who"];
        $query1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `customer_hash` = '$un' ");
        $nu = mysqli_fetch_assoc($query1);
        $ff = $nu["u_name"];
        $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `ref` = '$ff' ");
        $num = 1;
        while ($row = mysqli_fetch_assoc($query)) {
          echo ' 
                  <tr>
                      <td>'.$num.'</td>
                      <td>'.$row["u_name"].'</td>
                      <td>'.$row["f_name"].'</td>
                  </tr>
              ';
              $num++;
        }
      }  

      function manu(){
        $un = $_GET["who"];
        $query = mysqli_query($this->conn , " UPDATE `customer` SET `refr_id` = 'manu' WHERE `customer_hash` = '$un' ");
        if ($query) {
          // header('location : ');
          header("location: users.php");
        }
      }

      function auto(){
        $un = $_GET["who"];
        $query = mysqli_query($this->conn , " UPDATE `customer` SET `refr_id` = 'auto' WHERE `customer_hash` = '$un' ");
        if ($query) {

// UPDATE `customer` SET `refr_id` = 'auto' WHERE `customer_hash` = 'CUS_1247581'
          header("location: users.php");
        }
      }
        function stop_invest(){
        $investid = $_GET["invest_id"];
        $query = " SELECT * FROM `investment` WHERE `invest_id` = '$investid'";
        $process = mysqli_query($this->conn , $query);  
        $row = mysqli_fetch_assoc($process);
        $current_earn = round($row["realtime"]);
        $total_earn = $current_earn + $row["prin"];
        $customer = $row["who"];
        $query = mysqli_query($this->conn , " UPDATE `balance` SET `bal` = `bal` + '$total_earn' WHERE `serial` = '$customer' ");
        if ($query) {
          $query10 = mysqli_query($this->conn , " UPDATE `investment` SET `stopped` = 'yes', `payout` = 'yes' WHERE `invest_id` = '$investid' ");
          
          header("location: investment.php");
        }
      }
      function cac(){
          $query = mysqli_query($this->conn , " SELECT * FROM `customer` ");
          $num = mysqli_num_rows($query);
          echo $num + 617;
      }
      
     function dove(){
          $query = mysqli_query($this->conn , " SELECT * FROM `investment` ");
          $num = mysqli_num_rows($query);
          echo $num + 26;
      }

      private  function intrest($ref){
          $query = mysqli_query( $this->conn , " SELECT * FROM `customer` WHERE  `u_name` = '$ref' ");
          //echo "string";
          $amount = 10;
          if($query) {
            //echo "string";
            $row = mysqli_fetch_assoc($query);
            $serial = $row["customer_hash"];
            //echo $serial;
            $query1 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE `serial` = '$serial' ");
            if($query1) {
              $row1 = mysqli_fetch_assoc($query1);
              $bal =$row1["bal"];
              // echo $bal;  
              $new_bal = $bal + $amount;
              //echo $new_bal; 
              
              $query3 = mysqli_query($this->conn , " UPDATE `balance` SET `bal` = '$new_bal' WHERE `serial` = '$serial' ");
            }
          }else{
            echo "not";
          }
        }
        private function ref_bonus(string $ref, int $amount){
          $query = mysqli_query($this->conn , "SELECT `customer_hash` FROM `customer` WHERE `f_name` = '$ref'");
          $rowz =  mysqli_fetch_assoc($query);
          $cusid = $rowz['customer_hash'];
          $query1 = mysqli_query($this->conn , " SELECT * FROM `ref_bonus` WHERE `cus_hash` = '$cusid' ");
          if(mysqli_num_rows($query1) === 1){
            $query2 = mysqli_query($this->conn, " UPDATE `ref_bonus` SET `ref_bb` = `ref_bb`+$amount WHERE `cus_hash` = '$cusid' ");
          }else{
           $query2 = mysqli_query($this->conn, " INSERT INTO `ref_bonus`(`cus_hash`,`ref_bb`) VALUES('$cusid','$amount') ");
         }
        }

    function login(){
     //if(isset($_POST["login"])) {
        $un = mysqli_real_escape_string($this->conn, trim($_POST['uname']));
        $pass = mysqli_real_escape_string($this->conn, trim($_POST['password']));
        //echo $un." ".$pass;
        // $pass = hash('sha256', $pass);
        $query = " SELECT * FROM `customer` WHERE `u_name` = '$un' AND `password` = '$pass' ";
        $process = mysqli_query($this->conn , $query);
        if (mysqli_num_rows($process) == 1) {
           $row = mysqli_fetch_assoc($process);
           
           $_SESSION["un"] = $row["u_name"];
           $_SESSION["hash"] = $row["customer_hash"];
           $_SESSION["id"] = $row["customer_id"];
           //header("location: customer");
           echo 200;
           }else{
            echo ' Your username and password don\'t match ';
            }    
       } 
    //}


    function sobologin(){
      if(isset($_POST["sobo"])) {
        $un = mysqli_real_escape_string($this->conn, trim($_POST['username']));
        $pass = mysqli_real_escape_string($this->conn, trim($_POST['password']));
        //echo $un." ".$pass;
        // $pass = hash('sha256', $pass);
        $query = " SELECT * FROM `customer` WHERE `u_name` = '$un' AND `password` = '$pass' ";
        $process = mysqli_query($this->conn , $query);
        if (mysqli_num_rows($process) == 1) {
             $row = mysqli_fetch_assoc($process);
             if($row['email_verified'] == 1){
                $_SESSION["un"] = $row["u_name"];
                $_SESSION["hash"] = $row["customer_hash"];
                $_SESSION["id"] = $row["customer_id"]; 
                $_SESSION["umail"] = $row["email"];
                header("location: customer");
             }else{
                echo '<span style="color:red;">Your email has not been verified
                      <input type="hidden" id="usname" value="'.$row['u_name']. '" />
                      <input type="hidden" id="cusid" value="'.$row['customer_hash']. '" />
                      <input type="hidden" id="mail" value="'.$row['email']. '" />
                      <button id="verifymailform" style="border:transparent; background-color:transparent;cursor:pointer;">click here to resend link</button>
                    </span> 
                ';
             }
        
          
           }else{
             echo "<h4 style='color:red;'>No User Found</h4>";
            // echo "
            // <script>  
            // Swal.fire({
            //   title: 'Error!',
            //   text: 'Do you want to continue',
            //   icon: 'error',
            //   confirmButtonText: 'Cool'
            // })          
            // </script>
            // ";
          }    
       } 
    }
      function adminlogin(){
        if(isset($_POST["adminlogin"])) {
        $un = mysqli_real_escape_string($this->conn, trim($_POST['admin_un']));
        $pass = mysqli_real_escape_string($this->conn, trim($_POST['admin_pass']));
        $query = " SELECT * FROM `admin` WHERE `admin_name` = '$un' AND `admin_pass` = sha1('$pass') ";
        $process = mysqli_query($this->conn , $query);
        if (mysqli_num_rows($process) == 1) {
           $row = mysqli_fetch_assoc($process);
           
           $_SESSION["admin_name"] = $row["admin_name"];
           $_SESSION["admin_id"] = $row["admin_id"];

           
           header("location: dashboard");
              }else{
                  echo '
                  <div class="alert alert-danger">
                  Your username and password don\'t match
                  <div>

                    ';
                      }
                  } 
             }  
    function un(){
       echo $_SESSION["un"];
        }
        
    function create_bal(){
        $id = $_SESSION["hash"];
        $un = $_SESSION["un"];

        $query = " SELECT * FROM `balance` WHERE `serial` = '$id' ";
        $process = mysqli_query($this->conn , $query);
        if (mysqli_num_rows($process) == 0) {
               $query1 = " INSERT INTO `balance` (`bal`, `serial`, `bal_date`) VALUES ('0', '$id', NOW()) ";
               $process1 = mysqli_query($this->conn, $query1);
               if ($process1) {
                   echo ' <div class="alert alert-default card">
                        Dear '.$un.' your account has been created successfully
                   </div> ';
               } 
        }    
     }
    function getbal(){
        $id = $_SESSION["hash"];
        
        $query = " SELECT * FROM `balance` WHERE `serial` = '$id' ";
        $process = mysqli_query($this->conn , $query);
        if ($process) {
          if(mysqli_num_rows($process) == 1){
            $row = mysqli_fetch_assoc($process);
            $bal =  $row["bal"];
            echo number_format($bal);
          }else{
            $bal = 0;
            echo number_format($bal);
          }
           
          }
        }
        function totalearn(){
          $id = $_SESSION["hash"];

          $query = " SELECT * FROM `earned` WHERE `cus_hash` = '$id' ";
          $process = mysqli_query($this->conn, $query);
          if ($process) {
            if (mysqli_num_rows($process) == 1) {
              $row = mysqli_fetch_assoc($process);
              $bal =  $row["earn_amount"];
              echo number_format($bal);
            } else {
              $bal = 0;
              echo number_format($bal);
            }
          }
        }
        function totalinvest(){
          $id = $_SESSION["hash"];
          $query = " SELECT * FROM `investment` WHERE `who` = '$id' ";
          $process = mysqli_query($this->conn, $query);
          $principal = 0;
         while ($row = mysqli_fetch_assoc($process)) {
         
            $principal +=$row['prin'];
          }
          echo number_format($principal);
        }
        function totalbonus(){
           $id = $_SESSION["hash"];

          $query = " SELECT `ref_bb` FROM `ref_bonus` WHERE `cus_hash` = '$id' ";
          $process = mysqli_query($this->conn, $query);
          if ($process) {
            if (mysqli_num_rows($process) == 1) {
              $row = mysqli_fetch_assoc($process);
              $bal =  $row["ref_bb"];
              echo number_format($bal);
            } else {
              $bal = 0;
              echo number_format($bal);
            }
          }
        }

        function ethupull(){

            $un = $_SESSION["un"];   
         $process = mysqli_query($this->conn , " SELECT * FROM `paytype` WHERE `pay_name` = 'etherum' ");
         $n = mysqli_fetch_assoc($process);
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `u_name` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo '
                    <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl='.$n["pay_value"].'&choe=UTF-8" class="img-fluid " />  
                    <ul class="list-group">
                        <li class="list-item">NAME: '.$row["f_name"].' </li>
                        <li class="list-item">EMAIL: '.$row["email"].'</li>
                        <li class="list-item">OPTION: ETHERUM </li>
                      
                        <li class="list-item"> ETHERUM ID:  <input type="text" id="mybtc" style="text-align: center;" class="form-control" readonly="yes" value="'.$n["pay_value"].'" /> <br> <button id="mybt" class="btn btn-info"> Copy</button> <a class="btn btn-info" href="index.php">Done</a>  </li>
                    </ul>  
                    ';            
                }

        }
        function btccpull(){

            $un = $_SESSION["un"];   
         $process = mysqli_query($this->conn , " SELECT * FROM `paytype` WHERE `pay_name` = 'bitcash' ");
         $n = mysqli_fetch_assoc($process);
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `u_name` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo '
                                          <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl='.$n["pay_value"].'&choe=UTF-8" class="img-fluid " />  
                                          <ul class="list-group">
                                              <li class="list-item">NAME: '.$row["f_name"].' </li>
                                              <li class="list-item">EMAIL: '.$row["email"].'</li>
                                              <li class="list-item">OPTION: BITCOIN CASH </li>
                                            
                                              <li class="list-item"> ETHERUM ID:  <input type="text" id="mybtc" style="text-align: center;" class="form-control" readonly="yes" value="'.$n["pay_value"].'" /> <br> <button id="mybt" class="btn btn-info"> Copy</button> </li>
                                          </ul>  
                    ';            
                }


        }


          function perpull(){

            $un = $_SESSION["un"];   
         $process = mysqli_query($this->conn , " SELECT * FROM `paytype` WHERE `pay_name` = 'perfect' ");
         $n = mysqli_fetch_assoc($process);
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `u_name` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo '
                    <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl='.$n["pay_value"].'&choe=UTF-8" class="img-fluid " />  
                    <ul class="list-group">
                        <li class="list-item">NAME: '.$row["f_name"].' </li>
                        <li class="list-item">EMAIL: '.$row["email"].'</li>
                        <li class="list-item">OPTION: PERFECT MONEY </li>
                        <li class="list-item"> PERFECT MONEY ADDRESS:  <input type="text" id="mybtc" style="text-align: center;" class="form-control" readonly="yes" value="'.$n["pay_value"].'" /> <br> <button id="mybt" class="btn btn-info"> Copy</button> </li>
                    </ul>  
                    ';            
                }


        }
        function bankpull(){

          $un = $_SESSION["un"];   
       $process = mysqli_query($this->conn , " SELECT * FROM `paytype` WHERE `pay_name` = 'bank_transfer' ");
       $n = mysqli_fetch_assoc($process);
       $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `u_name` = '$un' ");
              if( $row = mysqli_fetch_assoc($process1)) { 
              echo '
                  <ul class="list-group">
                      <li class="list-item">NAME: '.$row["f_name"].' </li>
                      <li class="list-item">EMAIL: '.$row["email"].'</li>
                      <li class="list-item">OPTION: BANK TRANSFER </li>
                      <li class="list-item"> BANK DETAILS:  <input type="text" id="mybtc" style="text-align: center;" class="form-control" readonly="yes" value="'.$n["pay_value"].'" /> <br> <a href="deposite_log.php" class="btn btn-info">Done</a></li>
                  </ul>  
                  ';            
              }


      }
        function usdtpull(){

          $un = $_SESSION["un"];   
       $process = mysqli_query($this->conn , " SELECT * FROM `paytype` WHERE `pay_name` = 'usdt' ");
       $n = mysqli_fetch_assoc($process);
       $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `u_name` = '$un' ");
              if( $row = mysqli_fetch_assoc($process1)) { 
              echo '
                  <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl='.$n["pay_value"].'&choe=UTF-8" class="img-fluid " />  
                  <ul class="list-group">
                      <li class="list-item">NAME: '.$row["f_name"].' </li>
                      <li class="list-item">EMAIL: '.$row["email"].'</li>
                      <li class="list-item">OPTION: USDT </li>
                      <li class="list-item"> USDT ADDRESS:  <input type="text" id="mybtc" style="text-align: center;" class="form-control" readonly="yes" value="'.$n["pay_value"].'" /> <br> <button id="mybt" class="btn btn-info"> Copy</button> <a href="deposite_log.php" class="btn btn-info">Done</a></li>
                  </ul>  
                  ';            
              }


      }

        function btcpull(){
         $un = $_SESSION["un"];   
         $process = mysqli_query($this->conn , " SELECT * FROM `paytype` WHERE `pay_name` = 'btc' ");
         $n = mysqli_fetch_assoc($process);
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `u_name` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo '
                  <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl='.$n["pay_value"].'&choe=UTF-8" class="img-fluid " />  
                  <ul class="list-group">
                      <li class="list-item">NAME: '.$row["f_name"].' </li>
                      <li class="list-item">EMAIL: '.$row["email"].'</li>
                      <li class="list-item">OPTION: BTC</li>
                      <li class="list-item">Reference ID: '.$row["refr_id"].'</li>
                      <li class="list-item">BTC ID:  <input type="text" id="mybtc" style="text-align: center;" class="form-control" readonly="yes" value="'.$n["pay_value"].'" /> <br> <button id="mybt" class="btn btn-info"> Copy</button> <a href="index.php" class="btn btn-info">Done</a></li>
                  </ul>  
                    ';            
                }
        }

      function funding(){
       
            //  echo "shit";
                $amount = mysqli_real_escape_string($this->conn, trim($_GET['amount'])); 
                $ty = mysqli_real_escape_string($this->conn, trim($_GET['type'])); 

               
                 $who = $_SESSION["hash"];
                 $token = MD5(rand(100000,999999));
                $query = "INSERT INTO `deposite` (`who`, `token`, `oid`, `status`, `amount`, `time`) VALUES ( '$who', '$token', '$ty', 'no', '$amount', NOW())";
                  $process = mysqli_query($this->conn , $query);
                  if (!$process) {
                    echo mysqli_error($this->conn);
                  }
                  $query2 = " SELECT `f_name` FROM `customer` WHERE `customer_hash` = '$who'";
                  $process2 = mysqli_query($this->conn , $query2);
                  $row = mysqli_fetch_assoc($process2);
                  $subject = 'New Deposit from '.$row['f_name'];
                  $body = '<p>Theres been a new deposit from '.$row['f_name'].'</p>
                  <p>amount: '.$amount.'</p>';
                  $this->mailSender('ominecoinlimited@gmail.com',$subject,$body,'no-reply@ominecoinltd.com');

    if ($ty == "btc") {
      echo 'payingbtc.php';
    }
    if ($ty == "etherum") {
      echo 'payetherum.php';
    }
    if ($ty == "bitcash") {
      // header("location : ");
      echo 'paybtcash.php';
    }
    if ($ty == "cc") {
      //header("location : paybtcc.php");
      echo 'paybtcc.php';
    }
    if ($ty == "bank_transfer") {
      //header("location : paybtcc.php");
      echo 'paybank.php';
    }
    if ($ty == "usdt") {
      //header("location : paybtcc.php");
      echo 'payusdt.php';
    }

    if ($ty == "perfect") {
      // header("location : paypal.php");
      echo 'perfect.php';
    }


               // echo $amount;
                //         \CoinGate\CoinGate::config(array(
                //     'environment'               => 'live', // sandbox OR live
                //     'auth_token'                => 'dPEiN99LzqCoE3teKMyLuz4VQhU6W5UsTKx6NLvy',
                //     'curlopt_ssl_verifypeer'    => TRUE // default is false
                // ));




                // $post_params = array(
                //                 'order_id'          => rand(10000,99999),
                //                 'price_amount'      =>  $amount,
                //                 'price_currency'    => 'USD',
                //                 'receive_currency'  => 'USD',
                //                 'callback_url'      => 'http://mainstreaminvestment.com/customer/deposite_log.php',
                //                 'cancel_url'        => 'http://mainstreaminvestment.com/customer/deposite_log.php',
                //                 'success_url'       => 'http://mainstreaminvestment.com/customer/deposite_log.php',
                //                 'title'             => 'Mainstream investment fund'
                //             );

                // $orders = \CoinGate\Merchant\Order::create($post_params);

                // if ($orders) {
                //  //   echo $orders->status;
                //    $time = $orders->created_at;
                //    $token = $orders->token;
                //    $sid = $orders->id;
                //    $url = $orders->payment_url;
                //    $who = $_SESSION["hash"];
                //    $aa = $orders->price_amount;
                   
                //    $query = "INSERT INTO `deposite` (`who`, `token`, `oid`, `amount`, `dep_time`) VALUES ( '$who', '$token', '$sid', '$aa', '$time')";
                //     $process = mysqli_query($this->conn , $query);
                //    if ($process) {
                //        echo $url;
                //    }
                //     // print_r($orders);
                // } else {
                //     # Order Is Not Valid 141908
                // }   
           } 
        function deposite_log(){
            $id = $_SESSION["hash"];
            $query = " SELECT * FROM `deposite` WHERE `who` = '$id' ";
            $process = mysqli_query($this->conn , $query);
            $num = 1;
            while ($row = mysqli_fetch_assoc($process)) {
              echo '
                    <tr>
                        <td>'.$num.'</td>
                        <td>'.$row["amount"].'</td>
                        <td>'.$row["token"].'</td>
                        <td>'.$row["status"].'</td>
                        <td>'.$row["time"].'</td>
                    </tr>
                ';
            $num++;
            }

        }  

       function withdrawal_log(){
            $id = $_SESSION["hash"];
           // echo $id;
            $query = " SELECT * FROM `withdrawal` WHERE `who` = '$id' ORDER BY `withdrawal`.`with_date` DESC ";
            $process = mysqli_query($this->conn , $query);
            if ($process) {
                $num = 1;
                while ($row =  mysqli_fetch_assoc($process)) {
                    echo '
                    
                    <tr>
                         <td>'.$num.'</td>
                         <td>'.$row["amount"].'</td>  
                         <td>'.$row["with_date"].'</td>
                    </tr>
                     
                    ';
                    $num++;
                }
            }    
       } 

       function load_log(){
            $id = $_SESSION["hash"];
            $query = " SELECT * FROM `deposite` WHERE `who` = '$id' ORDER BY `deposite`.`time` ASC  ";
            $process = mysqli_query($this->conn , $query);
            if ($process) {
                $num = 1;
                while ($row =  mysqli_fetch_assoc($process)) {
                    echo '
                    
                    <tr>
                         <td>'.$num.'</td>
                         <td>'.$row["amount"].'</td>
                         <td>'.$row["oid"].'</td>
                         <td>'.($row["status"] == "yes" ? 'Paid' : 'Unpaid').'</td>   
                         <td>'.$row["time"].'</td>
                    </tr>
                     
                    ';
                    $num++;
                }
            }    
       }        
       function refferals(){
           $un = $_SESSION["un"];
           $query = " SELECT * FROM `customer` WHERE `ref` = '$un' ";
           $process = mysqli_query($this->conn , $query);
            $num = 1;
           while ($row = mysqli_fetch_assoc($process)) {
               echo '

            <tr>
                   <td>'.$num.'</td>
                   <td>'.$row["time"].'</td>
                  <td>'.$row["f_name"].'</td>
                   <td>'.$row["u_name"].'</td>
                   <td>'.$row["email"].'</td>
                   <td>'.$row["phone"].'</td>
            </tr>

                    ';
                    $num++;
           }
       }

       function totalwith(){
            $id = $_SESSION["hash"];
            $amount  = 0;
            $query = " SELECT * FROM `withdrawal` WHERE `who` = '$id' ";
            $process = mysqli_query($this->conn , $query);
            while ($row = mysqli_fetch_assoc($process)) {
                $amount  = $amount+$row["amount"];
            }
            echo number_format($amount);
       }

       function totaldep(){
            $id = $_SESSION["hash"];
            $amount  = 0;
            $query = " SELECT * FROM `deposite` WHERE `who` = '$id' and `status` = 'yes' ";
            $process = mysqli_query($this->conn , $query);
            while ($row = mysqli_fetch_assoc($process)) {
                $amount  = $amount+$row["amount"];
            }
            echo number_format($amount);
       }
      function starter_invest(){
         $id = $_SESSION["hash"]; 
         $query = " SELECT * FROM `balance` WHERE `serial` = '$id' ";
         $process = mysqli_query($this->conn , $query);
         $row = mysqli_fetch_assoc($process);
         $ban = $row["bal"];
        
        $plan = mysqli_real_escape_string($this->conn, trim($_GET["plan"]));
         $amount = mysqli_real_escape_string($this->conn, trim($_GET["amount"]));
         $dura = mysqli_real_escape_string($this->conn, trim($_GET["dura"]));
         $pect = mysqli_real_escape_string($this->conn, trim($_GET["pect"]));
         $bonus = mysqli_real_escape_string($this->conn, trim($_GET["bonus"]));

         $bal = (int) mysqli_real_escape_string($this->conn, trim($_GET["bal"]));
         $now = time();
         //518400
         //$then = $now + 86400;
         //$newbal = $ban - $amount;
        // echo $bal.' '.$amount.' '.$ban.'<br>';
         //echo $newbal;

         $earn = $amount * ($pect/100);
         $then = $now + $dura;
         $newbal = $ban - $amount;
          $real_bonus = $amount * ($bonus/100);
        

         if ( $amount > $ban ) {
             echo 'getfund';         
          // echo $amount." ".$bal;
          exit();

         }else{
             $query1 = " INSERT INTO `investment` ( `plan`,`who`, `prin`, `start_time`, `end_time`, `new_bal`, `time`) VALUES ('$plan','$id','$amount', '$now', '$then','$earn', NOW()) ";
             $process1 = mysqli_query($this->conn , $query1);
            $queryz = mysqli_query($this->conn, "SELECT * FROM `customer` WHERE `customer_hash` = '$id'");
            $rowz =  mysqli_fetch_assoc($queryz);
            if($rowz['ref'] != 'cup'){
              $this->ref_bonus($rowz['ref'],$real_bonus);
            }
             if ($process1) {
                $query2 = " UPDATE `balance` SET `bal` = '$newbal' WHERE `balance`.`serial` = '$id' ";
                $process2  = mysqli_query($this->conn , $query2);
                if ($process2) {
                  $to = $_SESSION["umail"];
                  $un = $_SESSION["un"];
                  $subject = "Investment on $plan is Successful";
                  $message =  '
                  <!DOCTYPE html>
                  <html>
                  <head>
                      <title>Account confirmation mail</title>
                      <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
                  </head>

                  <body style="padding: 40px; background-color: rgb(237, 236, 236); font-family:Cabin,sans-serif;">

                      <div style="color: #fff; text-align: center; padding-bottom: 20px;">
                          <img src="https://' . $_SERVER['HTTP_HOST'] . '/images/logo.png" alt="Ominecoin Limited">
                      </div>
                  <div style="background: #fff; padding: 30px;">
                    <h3>Dear  (' . $un . ') , </h3>
                    <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                     You have successfully invested $' . $amount . ' on ' . $plan . ' see details below</p>
                    </p>

                      <div style="margin-top: 10px;">
                          <table style="width: 100%; border-collapse: collapse; width: 100%; border: none; text-align: left;">
                              <tr style="border: 1px solid rgb(240, 240, 240); text-align: left;">
                                  <td style="padding: 15px;">Username</td>
                                  <td style="padding: 15px;">' . $un . '</td>
                              </tr>
                              <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;">Plan name</td>
                                  <td style="padding: 15px;">' . $plan . '</td>
                              </tr>

                              <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;">Percentage</td>
                                  <td style="padding: 15px;">' . $pect . '%</td>
                              </tr>
                              <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;"> Available balance ($)</td>
                                  <td style="padding: 15px;">' . $newbal . '</td>
                              </tr>
                              <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;"> Investment duration ($)</td>
                                  <td style="padding: 15px;">' . $this->secondsToWords($dura) . '</td>
                              </tr>
                          </table>
                      </div>
                      <hr style="margin-top: 75px; border: none; height: 2px; background-color:rgb(255, 194, 62);">
                      <div style="padding: 2px 20px 20px 20px;">
                          <p>Dear valued customer, <b>Ominecoin Limited</b> will never ask for your account Id during withdrawal </p>
                          <p style="text-align: justify;">We are a company that strives to stay
                              in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can
                              offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and
                              automated payment processing has enabled us to find ways to offer more to our clients. We offers an
                              investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a
                              reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have
                              come as a Bitcoin investment company.</p>
                          <ul>
                              <li> Our offical Email for customer support is <a style="color: #f7923a;"
                                      href="mailto:admin@ominecoinltd.com">mailto:admin@ominecoinltd.com </a> </li>
                              <li> login to dashboard: https://ominecoinltd.com </li>
                          </ul>
                      </div>
                  </div>

                  </body>

                  </html> ';
                  $mail_stat = $this->mailSender($to,$subject,$message,'no-reply@ominecoinltd.com');
                  if($mail_stat === 'success'){
                    echo 'investment_log.php';
                  }else{
                   //echo "message could not be sent";
                   echo 'investment_log.php';
                  }
                  
                  
                  

                   // header("location: investment_log.php");
                }
             }
         }
      } 
      private function calculator($id){
          $query = " SELECT * FROM `investment` WHERE `invest_id` = '$id' ";
          $process = mysqli_query($this->conn , $query);
          $row = mysqli_fetch_assoc($process);
          $pri = $row["prin"];
          $newbal = $row["new_bal"];
          $start = $row["start_time"];
          $end = $row["end_time"];
          $time = $end - $start;
          $addit = $newbal/$time;
          return $addit;
      }
      function shit(){
        $who = $_SESSION["hash"];
        $query = " SELECT * FROM `investment` WHERE `who` = '$who' ORDER BY `time` DESC ";
        $process = mysqli_query($this->conn , $query);  
        $num = 1;
        $hash = $_SESSION["hash"]; 
        while ( $row = mysqli_fetch_assoc($process)) {
            $voi = $row["realtime"];
            $timer = "00:00:00:00";
            $now = time();
            $end = $row["end_time"];
            $who = $row["who"];
            $newbal = $row["prin"] + $row["new_bal"];
            if($row["confirm"] == 'no' && $row["stopped"] == 'no'){
                if ($now < $end) {
                $voi = $this->remain($row["invest_id"]);
                $retime =  $end - $now;
                $timer = gmdate("d:H:i:s",$retime);
            }else{
                //$timer = "00:00:00:00";
                 $this->final_update($row["invest_id"],$hash,$newbal);
            }
            }
          
            if($row["confirm"] == 'yes' && $row["payout"] == 'no'){
              $voi = $row["new_bal"];
               $statu = "AWAITING PAYOUT";
            }else if($row["confirm"] == "yes" && $row["payout"] == 'yes'){
              $voi = $row["new_bal"];
              $statu = "COMPLETED";
            }else if ($row["stopped"] == 'yes' && $row["payout"] == 'yes'){
              $statu = "CANCELLED";
            } else{
              $statu = "UNCOMPLETED";
            }
           
            echo' 

            <tr>
                 <td>'.$num.'</td>
                 <td>'.$row["plan"].'</td>
                 <td>$ '.$row["prin"].'</td>
                 <td> '.$timer.' </td>
                 <td>$ '.$voi.'</td>
                 <td> $ '.$row["new_bal"].' </td>
                 <td> '.$statu.' </td>
            </tr>

            ';
            $num++;
        }
      }
     private function remain($id){
          $query = " SELECT * FROM `investment` WHERE `invest_id` = '$id' ";
          $process = mysqli_query($this->conn , $query);
          $row = mysqli_fetch_assoc($process);       
          $now = time();
          $end = $row["end_time"];
          $who = $row["who"];
          $newbal = $row["new_bal"];
          if ($now <  $end) {
            $multipler = $this->calculator($id);
            $retime =  $end - $now;
            $total = $newbal - ($retime * $multipler);
            
            $query2 = " UPDATE `investment` SET `realtime` = '$total' WHERE `investment`.`invest_id` = '$id' ";
            $process2 = mysqli_query($this->conn , $query2);
            if ($process2) {
                return $total;
                //" ".$retime/60;
            // echo " <br>";
            //echo gmdate("H:i:s",$retime);
            }
          }else{
            return $newbal;
           }  
      }
      private function final_update($id, $who,$newbal){
         // echo $who;
          $query1 = mysqli_query($this->conn , " SELECT * FROM `investment` WHERE `invest_id` = '$id' AND `confirm` = 'no' ");
          if(mysqli_num_rows($query1) == 1){
            $row = mysqli_fetch_assoc($query1);
            if ( $row["confirm"] == "no") {
             $query3 = mysqli_query($this->conn , " UPDATE `investment` SET `confirm` = 'yes' WHERE `investment`.`invest_id` = '$id' ");
              //  if ($query3) {
              //      $query2 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE `serial` = '$who' ");
              //      $row1 = mysqli_fetch_assoc($query2);
              //      $b = $row1["bal"];
              //      $new = $b + $newbal;
              //  $query = mysqli_query($this->conn, "UPDATE `balance` SET `bal` = '$new' WHERE `balance`.`serial` = '$who' ");
  
              // }
          }
          }
    
      }
      function payout(){
        $id = $_GET["invest_id"];
         $query1 = mysqli_query($this->conn , " SELECT * FROM `investment` WHERE `invest_id` = '$id' AND `confirm` = 'yes' AND `payout` = 'no'");
         if($query1){
            $row = mysqli_fetch_assoc($query1); 
            $who = $row["who"];
            $earn = $row['new_bal'];
            $new_bal = $row["new_bal"] + $row["prin"];
            $query3 = mysqli_query($this->conn , " UPDATE `balance` SET `bal` = `bal` + '$new_bal' WHERE `balance`.`serial` = '$who'");
            $query4 = mysqli_query($this->conn , " UPDATE `earned` SET `earn_amount` = `earn_amount` + '$earn' WHERE `earned`.`cus_hash` = '$who'");
            $query5 = mysqli_query($this->conn , " UPDATE `investment` SET `payout` = 'yes' WHERE `invest_id` = '$id'");
            header("location: investment.php");
         }
       
      }
      function load_profile(){
        $id = $_SESSION["id"];
        $hash = $_SESSION["hash"];
        $query = " SELECT * FROM `customer` WHERE `customer_id` = '$id' AND `customer_hash` = '$hash' ";
        $process = mysqli_query($this->conn , $query);
        $row = mysqli_fetch_assoc($process);
        echo '

          <div class="form-group">
              <label for="name">USERNAME:</label>
              <input type="text" name="name" class="form-control input-flat" value="'.$row["u_name"].'" id="name" readonly="yes" />
          </div>

          <div class="form-group">
              <label for="name">NAME:</label>
              <input type="text" name="name" class="form-control input-flat" value="'.$row["f_name"].'" id="name" readonly="yes" />
          </div>

          <div class="form-group">
              <label for="phone">PHONE:</label>
              <input type="text" name="ph" class="form-control input-flat" value="'.$row["phone"].'" id="ph" required="yes" />
          </div>

          <div class="form-group">
              <label for="email">EMAIL:</label>
              <input type="email" name="em"  class="form-control input-flat" value="'.$row["email"].'" id="em" required ="yes" />
          </div> 

           <div class="form-group">
              <label for="name">BITCOIN ADDRESS:</label>
              <input type="text" name="btc" class="form-control input-flat" value="'.($row["btc"] == "none" ? ' ' : $row["btc"]).'" id="btc" />
          </div>

          <!--<div class="form-group">
              <label for="phone">PERFECT MONEY:</label>
              <input type="text" name="pfm" class="form-control input-flat" value="'.($row["pfm"] == "none" ? ' ' : $row["pfm"]).'" id="pfm" />
          </div>-->

          <div class="form-group">
              <label for="email">ETHERUM ADDRESS:</label>
              <input type="text" name="ether"  class="form-control input-flat" value="'.($row["ether"] == "none" ? ' ' : $row["ether"]).'" id="ether" />
          </div> 
         <!-- <div class="form-group">
              <label for="email">USDT ADDRESS:</label>
              <input type="text" name="lite"  class="form-control input-flat" value="'.($row["lite"] == "none" ? ' ' : $row["lite"]).'" id="lite" />
          </div> 
          <div class="form-group">
          <label for="email">BANK ACCOUNT:</label>
          <input type="text" name="bnktrns"  class="form-control input-flat" value="'.($row["bank_transfer"] == "none" ? ' ' : $row["bank_transfer"]).'" id="bnktrns" />
        </div> -->

            ';
      }
      function uptown(){
        $hash = $_SESSION["hash"];
        $ph = mysqli_real_escape_string($this->conn, trim($_GET['ph']));
        $em = mysqli_real_escape_string($this->conn, trim($_GET['em']));
        
        $btc = mysqli_real_escape_string($this->conn, trim($_GET['btc']));
        $ether = mysqli_real_escape_string($this->conn, trim($_GET['ether']));
        $lite = mysqli_real_escape_string($this->conn, trim($_GET['lite']));
        $pfm = mysqli_real_escape_string($this->conn, trim($_GET['pfm']));
        $bnktrsf = mysqli_real_escape_string($this->conn, trim($_GET['bnktrsf']));
        $query1 = " SELECT * FROM `customer` WHERE `email` = '$em' AND `phone` = '$ph' ";
        $process1 = mysqli_query($this->conn , $query1);
       // if (mysqli_num_rows($process1) == " ") {
             
            $query = " UPDATE `customer` SET `email` = '$em', `phone` = '$ph', `btc` = '$btc', `pfm` = '$pfm', `lite` = '$lite', `ether` = '$ether', `bank_transfer` = '$bnktrsf' WHERE `customer`.`customer_hash` = '$hash'";

            $process = mysqli_query($this->conn , $query);
            if ($process) {
              echo 'good';
              }
       // }else{
         // echo 'bad';
        //}
      }

      function updateuser(){
        //$hash = $_SESSION["hash"];
        $ph = mysqli_real_escape_string($this->conn, trim($_GET['ph']));
        $em = mysqli_real_escape_string($this->conn, trim($_GET['em']));
        $un = mysqli_real_escape_string($this->conn, trim($_GET['un']));
        $fn = mysqli_real_escape_string($this->conn, trim($_GET['fn']));
        $pwd = mysqli_real_escape_string($this->conn, trim($_GET['pwd']));
        $ref = mysqli_real_escape_string($this->conn, trim($_GET['ref']));
        $hash = mysqli_real_escape_string($this->conn, trim($_GET['hash']));
        $btc = mysqli_real_escape_string($this->conn, trim($_GET['btc']));
        $ether = mysqli_real_escape_string($this->conn, trim($_GET['ether']));
        $lite = mysqli_real_escape_string($this->conn, trim($_GET['lite']));
        $pfm = mysqli_real_escape_string($this->conn, trim($_GET['pfm']));
        $bnktrsf = mysqli_real_escape_string($this->conn, trim($_GET['bnktrsf']));
        //$query1 = " SELECT * FROM `customer` WHERE `email` = '$em' AND `phone` = '$ph' ";
        //$process1 = mysqli_query($this->conn , $query1);
       // if (mysqli_num_rows($process1) == " ") {
             
            $query = " UPDATE `customer` SET `email` = '$em', `f_name` = '$fn', `u_name` = '$un', 
            `password` = '$pwd', `ref` = '$ref', `phone` = '$ph', `btc` = '$btc', `pfm` = '$pfm', 
            `lite` = '$lite', `ether` = '$ether', `bank_transfer` = '$bnktrsf' WHERE 
            `customer`.`customer_hash` = '$hash'";

            $process = mysqli_query($this->conn , $query);
            if ($process) {
              echo 'good';
              }
       // }else{
         // echo 'bad';
        //}
      }
      function support(){
        $na = mysqli_real_escape_string($this->conn, trim($_GET['na']));
        $em = mysqli_real_escape_string($this->conn, trim($_GET['em']));
        $mess = mysqli_real_escape_string($this->conn, trim($_GET['mess']));
        if (isset($em) && isset($na) && isset($mess)) {
          echo "good";
       }
          //echo $na." ".$em." ".$mess;
      }
      function btcprice(){
        $page = file_get_contents('https://bitpay.com/api/rates');
        $my_array = json_decode($page, true);
       // print_r($my_array);
        $exchange_rate = $my_array[2]["rate"];
        echo number_format($exchange_rate);
        
      }
      function totaldepo(){
        $num = rand(1000000,9000000);
        $query = mysqli_query($this-> conn ," SELECT * FROM `deposite` WHERE `status` = 'yes' ");
        while ($row = mysqli_fetch_assoc($query)) {
          $num = $num + $row["amount"];
        }
        echo number_format($num).'+';
      }
      function totalwithhome(){
        $num = 90000000 + rand(1000000,9000000);
        
        echo number_format($num).'+';
      }

      function debitit(){


        $amount = mysqli_real_escape_string($this->conn, trim($_GET['amount']));
       // $pass = mysqli_real_escape_string($this->conn, trim($_GET['pass']));
        $who =  mysqli_real_escape_string($this->conn, trim($_GET['who']));
        $hash = mysqli_real_escape_string($this->conn, trim($_GET['pass']));

        $query = " SELECT * FROM `customer` WHERE `u_name` = '$who' ";
        $process = mysqli_query($this->conn , $query);
        $n = mysqli_fetch_assoc($process);
        $em = $n["email"];
        if (mysqli_num_rows($process) == " ") {
          echo '<div class="alert alert-danger"> 
                Your password is not correct 
          </div>';
          exit();

        }else{
          $query1 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE `serial` = '$hash'");
          $row = mysqli_fetch_assoc($query1);
          if ($row["bal"] > $amount) {
            $newbal = $row["bal"] - $amount;
            $query2 = mysqli_query($this->conn," UPDATE `balance` SET `bal` = '$newbal' WHERE `balance`.`serial` ='$hash'");
            if ($query2) {
              $q = " INSERT INTO `withdrawal` (`who`, `amount`, `with_date`) VALUES ('$hash', '$amount', NOW()) ";
              $sql = mysqli_query($this->conn , $q );
              if ($sql) {
                 $page = file_get_contents('https://bitpay.com/api/rates');
                 $my_array = json_decode($page, true);
                // print_r($my_array);
                 $exchange_rate = $my_array[2]["rate"];
                 $num =  $exchange_rate;
                // echo $num;
                 $book =  $amount/$num;
                  $this->ssd($hash,$amount,$btc,$em,$n["u_name"]);
                
                 // $subject = "Customer account withdrawal ";
                        
                 //        $message = '
                
                 //            <!DOCTYPE html>
                 //            <html>
                 //            <head>
                 //              <title>Account confirmation mail</title>
                 //                   <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
                 //            </head>
                                                
                 //            <body style="margin: 20px 20px 20px 20px; border: 1px solid #f7923a;  padding: 5px 5px 5px 5px; font-family: "Cabin", sans-serif;">
                              
                 //              <div style="background: #fff; color: #fff; text-align: center; padding-top: 15px; padding-bottom: 15px;" >
                 //                <img src="https://quickaccessbinary.com/img/logo/logo.jpg"><h1 style="margin-top: 0px;"> Quick Access Binary </h1>
                 //              </div>
                            
                              
                 //              <h3>Welcome('.$n["u_name"].') , </h3>
                 //              <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                 //              Dear '.$n["f_name"].' '.$n["l_name"].' Your withdrawal request has been successfully processed and should have reflected in your account by now. Enjoy your earnings and let our bonding grow stronger. Have a great day.<br> 
                 //              </p>

                 //              <div style="margin-top: 10px;">
                 //              withdrawal details
                 //                 <table style="width: 100%; border-collapse: collapse; width: 100%; border: 1px solid #ddd; text-align: left;">
                 //                <tr style="border: 1px solid #ddd; text-align: left;">
                 //                  <td style="padding: 15px;">Date</td>
                 //                  <td style="padding: 15px;">'.date(DATE_RFC822).'</td>
                 //                </tr>
                 //                <tr style="border: 1px solid #ddd; text-align: left;">
                 //                  <td style="padding: 15px;">Payment Method</td>
                 //                  <td style="padding: 15px;"> Bitcoin</td>
                 //                </tr>
                 //                <tr style="border: 1px solid #ddd; text-align: left;">
                 //                  <td style="padding: 15px;">Customer ID</td>
                 //                  <td style="padding: 15px;">'.$hash.'</td>
                 //                </tr>
                 //                <tr style="border: 1px solid #ddd; text-align: left;">
                 //                  <td style="padding: 15px;">Amount</td>
                 //                  <td style="padding: 15px;"> ($'.$amount.') ('.$book.')</td>
                 //                </tr>
                 //                <tr style="border: 1px solid #ddd; text-align: left;">
                 //                  <td style="padding: 15px;">Comment</td>
                 //                  <td style="padding: 15px;"> Your withdrawal is paid successfully</td>
                 //                </tr>
                 //              </table>
                 //              </div>
                              
                 //              <div style="background:#333; padding: 20px 20px 20px 20px; color: antiquewhite;">
                 //                <p>Dear valued customer Quick Access will never ask for your account Id during withdrawal </p>
                 //                <p style="font-family: sans-serif; font-size: 14px; text-align: justify;">We are a company that strives to stay in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and automated payment processing has enabled us to find ways to offer more to our clients. Easy Crypto Bit offers an investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have come as a Bitcoin investment company.</p>
                 //                <ul>
                 //                  <li> Our offical Email for customer support is <a style="color: #f7923a;" href="mailto:info@quickaccessbinary.com">mailto:info@quickaccessbinary.com </a>  </li>
                 //                  <li> login to dashboard: https://www.quickaccessbinary.com/signin.php</li>
                 //                </ul>
                 //              </div>
                              
                 //            </body>
                 //            </html>
                                
                         
                 //                ';
                 //        // Always set content-type when sending HTML email
                 //        $headers = "MIME-Version: 1.0" . "\r\n";
                 //        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        
                 //        // More headers
                 //        $headers .= 'From: INFO<info@quickaccessbinary.com>' . "\r\n";
                        

                 //        $send = mail($em,$subject,$message,$headers);
                    
                    //  echo '
                    //     The penalty request has been recieved and processed   
                    // ';


              }
            }

           
          }else{
            echo ' 
              The  account balance is low. 
          ';
          }
        }
     }
     function manlook(){
      $query = mysqli_query($this->conn, " SELECT * FROM `within` , `customer` WHERE `customer`.`customer_hash` = `within`.`who` ");
       $num = 1;
      while ($row = mysqli_fetch_assoc($query)) {
          echo '
                     <tr>
                        <td>'.$num.'</td>
                        <td>'.$row["u_name"].'</td>
                        <td>'.$row["amount"].'</td>
                        <td>'.($row["status"] == "pending" ? '<a href="confirm.php?who='.$row["customer_hash"].'&amount='.$row["amount"].'&em='.$row["email"].'&un='.$row["u_name"].'&idd='.$row["w_id"].'&btc='.$row["some"].'" class="btn btn-success"> Confirm now</a>' : 'confirmed ').'</td>
                        <td>'.$row["some"].'</td>
                        <td>'.$row["date"].'</td>
                     </tr>
              ';
              $num++;
      }
     }
     function adminwithlog(){
      $query = mysqli_query($this->conn , " SELECT * FROM `withdrawal`,`customer` WHERE `withdrawal`.`who` = `customer`.`customer_hash` ");
      $num = 1;
      while ($row = mysqli_fetch_assoc($query)) {
          echo '
                     <tr>
                        <td>'.$num.'</td>
                        <td>'.$row["u_name"].'</td>
                        <td>'.$row["amount"].'</td>
                        <td>'.$row["where"].'</td>
                        <td>'.$row["with_date"].'</td>
                     </tr>
              ';
              $num++;
      }
     }
     function withdrawal(){
        $amount = mysqli_real_escape_string($this->conn, trim($_GET['amount']));
        $pass = mysqli_real_escape_string($this->conn, trim($_GET['pass']));
        $btc =  mysqli_real_escape_string($this->conn, trim($_GET['btc']));
        $hash = $_SESSION["hash"];
        $query = " SELECT * FROM `customer` WHERE `customer_hash` = '$hash' AND `password` = '$pass'";
        $process = mysqli_query($this->conn , $query);
        if (mysqli_num_rows($process) == 0) {
          echo '<div class="alert alert-danger"> 
                Your password is not correct 
          </div>';
          //exit();

        }else{
          $n = mysqli_fetch_assoc($process);
          $em = $n["email"];
          $un = $n["u_name"];
                     if ($n["refr_id"] == "manu") {
                      $vv = " INSERT INTO `within` (`who`, `status`, `some`,`amount`, `date`) VALUES ('$hash', 'pending', '$btc','$amount', NOW())";
                        $dd = mysqli_query($this->conn , $vv);

                        $subj = "Withdrawal Request Created Successfully";
                        $message = '

                      <!DOCTYPE html>
                      <html>
                      <head>
                          <title>Account confirmation mail</title>
                          <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
                      </head>

                      <body style="padding: 40px; background-color: rgb(237, 236, 236); font-family:Cabin,sans-serif;">

                          <div style="color: #fff; text-align: center; padding-bottom: 20px;">
                              <img src="https://' . $_SERVER['HTTP_HOST'] . '/images/logo.png" alt="Ominecoin Limited">
                          </div>
                      <div style="background: #fff; padding: 30px;">
                         <h3>Dear (' . $un . ') , </h3>
                         <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                         Dear ' . $un . ' Your withdrawal request has been created successfuly. you will recieve an email as soon as funds are paid into your account. Have a great day.<br> 
                         </p>

                          <div style="margin-top: 10px;">
                              <table style="width: 100%; border-collapse: collapse; width: 100%; border: none; text-align: left;">
                                  <tr style="border: 1px solid rgb(240, 240, 240); text-align: left;">
                                      <td style="padding: 15px;">Payment Method/Address </td>
                                      <td style="padding: 15px;"> ' . $btc . '</td>
                                  </tr>
                                  <tr style="border: 1px solid #ddd; text-align: left;">
                                      <td style="padding: 15px;">Customer ID</td>
                                      <td style="padding: 15px;">' . $hash . '</td>
                                  </tr>

                                  <tr style="border: 1px solid #ddd; text-align: left;">
                                    <td style="padding: 15px;">Amount</td>
                                    <td style="padding: 15px;"> ($' . $amount . ')</td>
                                  </tr>
                                  <tr style="border: 1px solid #ddd; text-align: left;">
                                      <td style="padding: 15px;">Mobile number</td>
                                      <td style="padding: 15px;">Not Added</td>
                                  </tr>
                                   <tr style="border: 1px solid #ddd; text-align: left;">
                                      <td style="padding: 15px;">Comment</td>
                                      <td style="padding: 15px;"> Your withdrawal request has been recieved</td>
                                    </tr>
                              </table>
                          </div>
                          <hr style="margin-top: 75px; border: none; height: 2px; background-color:rgb(255, 194, 62);">
                          <div style="padding: 2px 20px 20px 20px;">
                              <p>Dear valued customer, <b>Ominecoin Limited</b> will never ask for your account Id during withdrawal </p>
                              <p style="text-align: justify;">We are a company that strives to stay
                                  in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can
                                  offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and
                                  automated payment processing has enabled us to find ways to offer more to our clients. We offers an
                                  investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a
                                  reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have
                                  come as a Bitcoin investment company.</p>
                              <ul>
                                  <li> Our offical Email for customer support is <a style="color: #f7923a;"
                                          href="mailto:admin@ominecoinltd.com">mailto:admin@ominecoinltd.com </a> </li>
                                  <li> login to dashboard: https://ominecoinltd.com </li>
                              </ul>
                          </div>
                      </div>

                      </body>

                      </html>';
                      
                       $mail_stat = $this->mailSender($em,$subj,$message,'no-reply@ominecoinltd.com');
                       if($mail_stat === 'success'){
                        echo 'sent';
                       }else{
                        echo "message could not be sent";
                       }

                       echo '<div class="alert alert-info"> 
                                 Your Withdrawal request has been sent to admin, you will recieve an email as soon as your funds are disbursed.
                                 <a href="index.php">ok</a>
                        </div>';

                       // exit();
                  }else{
                    echo '<div class="alert alert-info"> 
                    Your Withdrawal request has been processed successfully. 
                    </div>';
                    $this->ssd($hash,$amount,$btc,$em,$n["u_name"]);
                  }

            
        }
     }
     function gig(){
      $hash = $_GET["who"];
      $amount = $_GET["amount"];
      $em = $_GET["em"];
      $un = $_GET["un"];
      $id = $_GET["idd"];
      $btc = $_GET["btc"];

      $query = mysqli_query($this->conn , " UPDATE `within` SET `status` = 'confirm' WHERE `within`.`w_id` = '$id' ");
      if ($query) {
         $this->ssd($hash,$amount,$btc,$em,$un);
               header("location: manual.php");   
      }
     }
     private function ssd($hash,$amount,$btc,$em,$un){
          $query1 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE `serial` = '$hash'");
          $row = mysqli_fetch_assoc($query1);
          if ($row["bal"] > $amount) {
            $newbal = $row["bal"] - $amount;
            $query2 = mysqli_query($this->conn," UPDATE `balance` SET `bal` = '$newbal' WHERE `balance`.`serial` ='$hash'");
            if ($query2) {
              $q = " INSERT INTO `withdrawal` (`who`, `amount`, `where`,`with_date`) VALUES ('$hash', '$amount', '$btc',NOW()) ";
              $sql = mysqli_query($this->conn , $q );
              if ($sql) {
                       $page = file_get_contents('https://bitpay.com/api/rates');
                       $my_array = json_decode($page, true);
                      // print_r($my_array);
                       $exchange_rate = $my_array[2]["rate"];
                       $num =  $exchange_rate;
                      // echo $num;
                       $book =  $amount/$num;
                      
                       $to = $em;
                       $subject = "$un Withdrawal successfully sent";
                       
                       $message = '

                      <!DOCTYPE html>
                      <html>
                      <head>
                          <title>Account confirmation mail</title>
                          <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
                      </head>

                      <body style="padding: 40px; background-color: rgb(237, 236, 236); font-family:Cabin,sans-serif;">

                          <div style="color: #fff; text-align: center; padding-bottom: 20px;">
                              <img src="https://' . $_SERVER['HTTP_HOST'] . '/images/logo.png" alt="Ominecoin Limited">
                          </div>
                      <div style="background: #fff; padding: 30px;">
                          <h3>Welcome(' . $un . ') , </h3>
                         <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                         Dear ' . $un . ' Your withdrawal request has been successfully processed and should have reflected in your account by now. Enjoy your earnings and let our bonding grow stronger. Have a great day.<br> 
                         </p>

                          <div style="margin-top: 10px;">
                              <table style="width: 100%; border-collapse: collapse; width: 100%; border: none; text-align: left;">
                                   <tr style="border: 1px solid #ddd; text-align: left;">
                                      <td style="padding: 15px;">Date</td>
                                      <td style="padding: 15px;">' . date(DATE_RFC822) . '</td>
                                    </tr>-->
                                    <tr style="border: 1px solid #ddd; text-align: left;">
                                      <td style="padding: 15px;">Payment Method/Address </td>
                                      <td style="padding: 15px;"> ' . $btc . '</td>
                                    </tr>
                                    <tr style="border: 1px solid #ddd; text-align: left;">
                                      <td style="padding: 15px;">Customer ID</td>
                                      <td style="padding: 15px;">' . $hash . '</td>
                                    </tr>
                                    <tr style="border: 1px solid #ddd; text-align: left;">
                                      <td style="padding: 15px;">Amount</td>
                                      <td style="padding: 15px;"> ($' . $amount . ') (' . $book . ')</td>
                                    </tr>
                                    <tr style="border: 1px solid #ddd; text-align: left;">
                                      <td style="padding: 15px;">Comment</td>
                                      <td style="padding: 15px;"> Your withdrawal is paid successfully</td>
                                    </tr>
                              </table>
                          </div>
                          <hr style="margin-top: 75px; border: none; height: 2px; background-color:rgb(255, 194, 62);">
                          <div style="padding: 2px 20px 20px 20px;">
                              <p>Dear valued customer, <b>Ominecoin Limited</b> will never ask for your account Id during withdrawal </p>
                              <p style="text-align: justify;">We are a company that strives to stay
                                  in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can
                                  offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and
                                  automated payment processing has enabled us to find ways to offer more to our clients. We offers an
                                  investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a
                                  reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have
                                  come as a Bitcoin investment company.</p>
                              <ul>
                                  <li> Our offical Email for customer support is <a style="color: #f7923a;"
                                          href="mailto:admin@ominecoinltd.com">mailto:admin@ominecoinltd.com </a> </li>
                                  <li> login to dashboard: https://ominecoinltd.com </li>
                              </ul>
                          </div>
                      </div>

                      </body>

                      </html>';
                       
                       $mail_stat = $this->mailSender($to,$subject,$message,'no-reply@ominecoinltd.com');
                       if($mail_stat === 'success'){
                        echo '<div class="alert alert-info"> 
                          Your Withdrawal request has been recieved and processed   
                           </div>';
                       }else{
                        echo "message could not be sent";
                       }
              }
            }

           
          }
          else{
            echo '<div class="alert alert-danger"> 
                Your  account balance is low. 
          </div>';
          }
     }
     function showing(){
      $hash = $_SESSION["hash"];
      $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `customer_hash`= '$hash' ");
      $row = mysqli_fetch_assoc($query);
      echo $row["img"];
     // echo $hash;
     }
     function upload(){
      $hash = $_SESSION["hash"];
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["img"]["name"]);
      $type_of = $_FILES["img"]["type"];
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $news = $target_dir.rand().'.'.$imageFileType;
      // Check if file already exists
      if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
      }
          if (move_uploaded_file($_FILES["img"]["tmp_name"], $news)) {
              $query = " UPDATE `customer` SET `img` = '$news' WHERE `customer`.`customer_hash` = '$hash'";
            //echo "The file ". basename( $_FILES["img"]["name"]). " has been uploaded.";
              $process = mysqli_query($this->conn , $query);
              if ($process) {
                echo "good";
              }
          } else {
              echo "Sorry, there was an error uploading your file.";
          }
       } 
      function num_users(){
        $query = mysqli_query($this->conn , " SELECT * FROM `customer` ");
        $num = mysqli_num_rows($query);
        echo $num;
      }   
      function total_depsite(){
        $query = mysqli_query($this->conn , " SELECT * FROM `deposite` WHERE `status` = 'yes' ");
        $num  = NULL; 
        while ($row = mysqli_fetch_assoc($query)) {
          $num = $num + $row["amount"];
        }
        echo number_format($num);
      }
      function total_invest(){
        $query = mysqli_query($this->conn , " SELECT * FROM `investment` ");
        $num  = NULL; 
        while ($row = mysqli_fetch_assoc($query)) {
          $num = $num + $row["prin"];
        }
        echo number_format($num); 
      }
      function list_user(){
        $query = mysqli_query($this->conn , " SELECT * FROM `customer` ORDER BY `customer`.`time` DESC");
        //$num = mysqli_num_rows($query);
        $num = 1;
        while ($row = mysqli_fetch_assoc($query)) {
          echo '
                 <tr>
                    <td>'.$num.'</td>
                    <td>'.$row["u_name"].'</td>
                    <td>'.$row["customer_hash"].'</td>
                    <td>'.$row["phone"].'</td>
                    <td>'.$row["email"].'
                        <br>
                        <a href="sendm.php?email='.$row["email"].'" class="btn btn-success">Send Email</a>
                    </td>
                    <td>'.($row["refr_id"] == 'manu' ? '<a href="auto.php?who='.$row["customer_hash"].'" class="btn btn-success"> Make automatic </a>' : '<a href="manu.php?who='.$row["customer_hash"].'" class="btn btn-info"> Make Manual </a>').'</td>
                    <td><a href="userdata.php?who='.$row["customer_hash"].'" class="btn btn-info"> Go </a></td>
                    <td><a href="dele.php?id='.$row["customer_id"].'" class="btn btn-danger"> delete </a></td>
                 </tr>
          ';
          $num++;
        }
      }


      function bpanlty(){
        $query = mysqli_query($this->conn , " SELECT * FROM `customer` ORDER BY `customer`.`time` DESC");
        //$num = mysqli_num_rows($query);
        $num = 1;
        while ($row = mysqli_fetch_assoc($query)) {
          echo '
                 <tr>
                    <td>'.$num.'</td>
                    <td>'.$row["u_name"].'</td>
                    <td>'.$row["f_name"].'</td>
                    <td><a href="crediting.php?who='.$row["customer_hash"].'" class="btn btn-info"> 
                     Bouns   </a></td>
                    <td><a href="penalty.php?id='.$row["customer_hash"].'" class="btn btn-danger"> penalty </a></td>
                 </tr>
          ';
          $num++;
        }
      }

      function uuname(){
        $id = $_GET["who"];
        $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `customer_hash` = '$id' ");
        $row = mysqli_fetch_assoc($query);
        echo $row["u_name"];
      }

      function balance(){
        $id = $_GET["who"];
        $query = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE `serial` = '$id' ");
        
        if(mysqli_num_rows($query) == 1){
          $row = mysqli_fetch_assoc($query);
          echo $row["bal"];
        }else{
          echo 0;
        }
       
      }

      function getuu(){
      
        $id = $_GET["id"];
        $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `customer_hash` = '$id' ");
        $row = mysqli_fetch_assoc($query);
        echo $row["f_name"];
        echo ' <input type="hidden" id="pass" value="'.$row["customer_hash"].'" /> ';
        echo ' <input type="hidden" id="un" value="'.$row["u_name"].'" /> ';

      }

     function getuserData(){
      $id = $_GET["who"];
      $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `customer_hash` = '$id' ");
      $query2 = mysqli_query($this->conn , " SELECT `earn_amount` FROM `earned` WHERE `cus_hash` = '$id' ");
      if(mysqli_num_rows($query2) == 1){
        $row2 = mysqli_fetch_assoc($query2);
        $earned = $row2['earn_amount'];
      }else{
        $earned = 0;
      }
    $query3 = mysqli_query($this->conn, " SELECT `bal` FROM `balance` WHERE `serial` = '$id' ");
    if (mysqli_num_rows($query2) == 1) {
      $row3 = mysqli_fetch_assoc($query3);
      $bal = $row3['bal'];
    } else {
      $bal = 0;
    }
      
        
        while ($row = mysqli_fetch_assoc($query)) {
          echo '
                <!-- <tr>
                    <td> Full name </td>
                    <td>'.$row["f_name"].'</td>
                 </tr>
                 <tr>
                    <td> User name </td>
                    <td>'.$row["u_name"].'</td>
                 </tr>
                 <tr>
                    <td> User Email </td>
                    <td>'.$row["email"].'</td>
                 </tr>
                 <tr>
                    <td> User Password </td>
                    <td>'.$row["password"].'</td>
                 </tr>

                  <tr>
                    <td> User Phone </td>
                    <td>'.$row["phone"].'</td>
                 </tr>
                 <tr>
                    <td> Customer Id </td>
                    <td>'.$row["customer_hash"].'</td>
                 </tr>-->
                 <tr>
                    <td> Adjust Investment earning </td>
                    <td>
                      <form id="earnform" method="POST">
                        <input type="text" id="earn_amount" value="'.$earned.'" />&nbsp
                        <input type="hidden" id="cusid" value="'.$row['customer_hash']. '" />
                        <button type="submit">Adjust earning</button>
                      </form>
                    </td>
                 </tr>
                   <tr>
                    <td> Adjust account balance </td>
                    <td>
                      <form id="balform" method="POST">
                        <input type="text" id="bal" value="' .$bal. '" />&nbsp
                        <input type="hidden" id="custid" value="' . $row['customer_hash'] . '" />
                        <button type="submit">Adjust balance</button>
                      </form>
                    </td>
                 </tr>
                 <!--<tr>
                    <td> Customer Referral </td>
                    <td>'.$row["ref"].'</td>
                 </tr>
                 <tr>
                    <td> Customer Bitcoin  </td>
                    <td>'.$row["btc"].'</td>
                 </tr>
                 <tr>
                    <td> Customer Etherum  </td>
                    <td>'.$row["ether"].'</td>
                 </tr>
                 <tr>
                    <td> Customer Perfect Money  </td>
                    <td>'.$row["pfm"].'</td>
                 </tr>
                 <tr>
                    <td> Customer Usdt  </td>
                    <td>'.$row["lite"].'</td>
                 </tr>-->
          ';
         
        }
     }


  function load_profile2()
  {
    $id = $_GET["who"];
    $query = mysqli_query($this->conn, " SELECT * FROM `customer` WHERE `customer_hash` = '$id' ");
    $query2 = mysqli_query($this->conn, " SELECT `earn_amount` FROM `earned` WHERE `cus_hash` = '$id' ");
    if (mysqli_num_rows($query2) == 1) {
      $row2 = mysqli_fetch_assoc($query2);
      $earned = $row2['earn_amount'];
    } else {
      $earned = 0;
    }
    $query3 = mysqli_query($this->conn, " SELECT `bal` FROM `balance` WHERE `serial` = '$id' ");
    if (mysqli_num_rows($query2) == 1) {
      $row3 = mysqli_fetch_assoc($query3);
      $bal = $row3['bal'];
    } else {
      $bal = 0;
    }
    while ($row = mysqli_fetch_assoc($query)) {
    echo '

          <div class="form-group">
              <label for="name">USERNAME:</label>
              <input type="text" name="un" class="form-control input-flat" value="' . $row["u_name"] . '" id="un" />
          </div>
             <div class="form-group">
              <label for="name">Cus Hash:</label>
              <input type="text" name="hash" class="form-control input-flat" value="' . $row["customer_hash"] . '" id="hash" />
          </div>

          <div class="form-group">
              <label for="name">NAME:</label>
              <input type="text" name="fn" class="form-control input-flat" value="' . $row["f_name"] . '" id="fn" />
          </div>

          <div class="form-group">
              <label for="phone">PHONE:</label>
              <input type="text" name="ph" class="form-control input-flat" value="' . $row["phone"] . '" id="ph" required="yes" />
          </div>

          <div class="form-group">
              <label for="email">EMAIL:</label>
              <input type="email" name="em"  class="form-control input-flat" value="' . $row["email"] . '" id="em" required ="yes" />
          </div> 

          <div class="form-group">
              <label for="email">Password:</label>
              <input type="text" name="pwd"  class="form-control input-flat" value="' . $row["password"] . '" id="pwd" required ="yes" />
          </div> 

           <div class="form-group">
              <label for="email">Reffered by:</label>
              <input type="text" name="ref"  class="form-control input-flat" value="'  .$row["ref"]. '" id="ref" required ="yes" />
          </div> 

           <div class="form-group">
              <label for="name">BITCOIN ADDRESS:</label>
              <input type="text" name="btc" class="form-control input-flat" value="' . ($row["btc"] == "none" ? ' ' : $row["btc"]) . '" id="btc" />
          </div>

          <!--<div class="form-group">
              <label for="phone">PERFECT MONEY:</label>
              <input type="text" name="pfm" class="form-control input-flat" value="' . ($row["pfm"] == "none" ? ' ' : $row["pfm"]) . '" id="pfm" />
          </div>-->

          <div class="form-group">
              <label for="email">ETHERUM ADDRESS:</label>
              <input type="text" name="ether"  class="form-control input-flat" value="' . ($row["ether"] == "none" ? ' ' : $row["ether"]) . '" id="ether" />
          </div> 
         <!-- <div class="form-group">
              <label for="email">USDT ADDRESS:</label>
              <input type="text" name="lite"  class="form-control input-flat" value="' . ($row["lite"] == "none" ? ' ' : $row["lite"]) . '" id="lite" />
          </div> 
          <div class="form-group">
          <label for="email">BANK ACCOUNT:</label>
          <input type="text" name="bnktrns"  class="form-control input-flat" value="' . ($row["bank_transfer"] == "none" ? ' ' : $row["bank_transfer"]) . '" id="bnktrns" />
        </div> -->

            ';
    }
  }



      function ddaccount(){
          $who = mysqli_real_escape_string($this->conn, trim($_GET['who'])); 
          $amount = mysqli_real_escape_string($this->conn, trim($_GET['amount']));
          $bal = mysqli_real_escape_string($this->conn, trim($_GET['bal']));
          $id = $_GET["id"];
          $new = $amount + $bal;
          //echo $new;
           $process1 = mysqli_query($this->conn , " UPDATE `balance` SET `bal` = '$new' WHERE `balance`.`serial` = '$who' ");
           $query1 = mysqli_query($this->conn, "SELECT * FROM `earned` WHERE `cus_hash` = '$who' ");
           if (mysqli_num_rows($query1) != 1) {
            $process3 = mysqli_query($this->conn , " INSERT INTO `earned` (`cus_hash`,`earn_amount`,`created_at`) VALUES ('$who',0,NOW()) ");
           }
            $token = hash('sha256' , rand(100000,999999));
                
               $query = " UPDATE `deposite` SET `status` = 'yes' WHERE `deposite`.`deposite_id` = '$id' ";
                $process = mysqli_query($this->conn , $query);
                $pro1 = mysqli_query($this->conn, " SELECT * FROM `customer` WHERE `customer_hash` = '$who' ");
                $row1 = mysqli_fetch_assoc($pro1);
                   $em = $row1["email"];
                   $un = $row1["u_name"];
                   $fn = $row1["f_name"];
                   
                if ($process1) {

                  $to = $em;
                  $subject = "$fn  Account has been credited successfully ";
                  
                  $message =  '

                  <!DOCTYPE html>
                  <html>
                  <head>
                      <title>Account confirmation mail</title>
                      <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
                  </head>

                  <body style="padding: 40px; background-color: rgb(237, 236, 236); font-family:Cabin,sans-serif;">

                      <div style="color: #fff; text-align: center; padding-bottom: 20px;">
                          <img src="https://' . $_SERVER['HTTP_HOST'] . '/images/logo.png" alt="Ominecoin Limited">
                      </div>
                  <div style="background: #fff; padding: 30px;">
                      <h3>Welcome  (' . $un . ') , </h3>
                      <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                      Your account has been credited successfully login to find more details</p>
                      </p>

                      <div style="margin-top: 10px;">
                          <table style="width: 100%; border-collapse: collapse; width: 100%; border: none; text-align: left;">
                              <tr style="border: 1px solid #ddd; text-align: left;">
                                <td style="padding: 15px;">Username</td>
                                <td style="padding: 15px;">' . $un . '</td>
                              </tr>
                              <tr style="border: 1px solid #ddd; text-align: left;">
                                <td style="padding: 15px;">Full name</td>
                                <td style="padding: 15px;">' . $fn . '</td>
                              </tr>
                              
                              <tr style="border: 1px solid #ddd; text-align: left;">
                                <td style="padding: 15px;">Amount ($)</td>
                                <td style="padding: 15px;">' . $amount . '</td>
                              </tr>
                              <tr style="border: 1px solid #ddd; text-align: left;">
                                <td style="padding: 15px;"> Previous balanace ($)</td>
                                <td style="padding: 15px;">' . $bal . '</td>
                              </tr>
                              <tr style="border: 1px solid #ddd; text-align: left;">
                                <td style="padding: 15px;"> New balanace ($)</td>
                                <td style="padding: 15px;">' . $new . '</td>
                              </tr>
                          </table>
                      </div>
                      <hr style="margin-top: 75px; border: none; height: 2px; background-color:rgb(255, 194, 62);">
                      <div style="padding: 2px 20px 20px 20px;">
                          <p>Dear valued customer, <b>Ominecoin Limited</b> will never ask for your account Id during withdrawal </p>
                          <p style="text-align: justify;">We are a company that strives to stay
                              in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can
                              offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and
                              automated payment processing has enabled us to find ways to offer more to our clients. We offers an
                              investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a
                              reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have
                              come as a Bitcoin investment company.</p>
                          <ul>
                              <li> Our offical Email for customer support is <a style="color: #f7923a;"
                                      href="mailto:admin@ominecoinltd.com">mailto:admin@ominecoinltd.com </a> </li>
                              <li> login to dashboard: https://ominecoinltd.com </li>
                          </ul>
                      </div>
                  </div>

                  </body>

                  </html> ';
                  $mail_stat = $this->mailSender($to,$subject,$message,'no-reply@ominecoinltd.com');
                  if($mail_stat === 'success'){
                    echo 'sent';
                    // echo '
                    //   <script>
                    //   document.location.assign("deposite.php"); 
                    //   </script>
                    //   ';  
                  }else{
                      echo "message could not be sent";
                  // echo '
                  // <script>
                  // document.location.assign("deposite.php"); 
                  // </script>
                  // ';  
                  }

                  //check if the depositor has a referal                              
                  // $sqlll = mysqli_query($this->conn, " SELECT ref FROM `customer` WHERE `customer_hash` = '$who'");
                  // $rowww = mysqli_fetch_assoc($sqlll);
                  // if($rowww["ref"] !== 'cup' && $rowww["ref"] !== ''){
                  //   $referer = $rowww["ref"];
                  //   $sqlnoda = mysqli_query($this->conn, " SELECT * FROM `customer` WHERE `u_name` = '$referer'");
                  //   $res = mysqli_fetch_assoc($sqlnoda);
                  //   $dperson = $res["customer_hash"];
                  //   $refemail = $res["email"];
                  //   $refcom = floor((5/100) * $amount);
                  //   $sqlnod = mysqli_query($this->conn, " SELECT bal FROM `balance` WHERE `balance`.`serial` = '$dperson'");
                  //   $rez = mysqli_fetch_assoc($sqlnod);
                  //   $init_bal = $rez["bal"];
                  //   $netbal = $init_bal + $refcom;
                  //   $sqlm = mysqli_query($this->conn , " UPDATE `balance` SET `bal` = $netbal WHERE `balance`.`serial` = '$dperson'");
                  //   if($sqlm){
                  //     $msgSubject = "Referal Commission from $un";
                  //     $refmsg = '
                  //     <!DOCTYPE html>
                  //     <html>
                  //     <head>
                  //         <title>Account confirmation mail</title>
                  //         <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
                  //     </head>

                  //     <body style="padding: 40px; background-color: rgb(237, 236, 236); font-family:Cabin,sans-serif;">

                  //         <div style="color: #fff; text-align: center; padding-bottom: 20px;">
                  //             <img src="https://' . $_SERVER['HTTP_HOST'] . '/images/logo.png" alt="Ominecoin Limited">
                  //         </div>
                  //     <div style="background: #fff; padding: 30px;">
                  //          <h3>Dear  (' . $referer . ') , </h3>
                  //           <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                  //           You have recieved a referal commission from ' . $un . ' details below</p>
                  //           </p>

                  //         <div style="margin-top: 10px;">
                  //             <table style="width: 100%; border-collapse: collapse; width: 100%; border: none; text-align: left;">
                  //                <tr style="border: 1px solid #ddd; text-align: left;">
                  //                   <td style="padding: 15px;">Referee Username</td>
                  //                   <td style="padding: 15px;">' . $un . '</td>
                  //                 </tr>
                  //                 <tr style="border: 1px solid #ddd; text-align: left;">
                  //                   <td style="padding: 15px;">Referee Email Address</td>
                  //                   <td style="padding: 15px;">' . $to . '</td>
                  //                 </tr>
                                  
                  //                 <tr style="border: 1px solid #ddd; text-align: left;">
                  //                   <td style="padding: 15px;">Referer Commission ($)</td>
                  //                   <td style="padding: 15px;">' . $refcom . '</td>
                  //                 </tr>
                  //                 <tr style="border: 1px solid #ddd; text-align: left;">
                  //                   <td style="padding: 15px;"> Previous balanace ($)</td>
                  //                   <td style="padding: 15px;">' . $init_bal . '</td>
                  //                 </tr>
                  //                 <tr style="border: 1px solid #ddd; text-align: left;">
                  //                   <td style="padding: 15px;"> New balanace ($)</td>
                  //                   <td style="padding: 15px;">' . $netbal . '</td>
                  //                 </tr>
                  //             </table>
                  //         </div>
                  //         <hr style="margin-top: 75px; border: none; height: 2px; background-color:rgb(255, 194, 62);">
                  //         <div style="padding: 2px 20px 20px 20px;">
                  //             <p>Dear valued customer, <b>Ominecoin Limited</b> will never ask for your account Id during withdrawal </p>
                  //             <p style="text-align: justify;">We are a company that strives to stay
                  //                 in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can
                  //                 offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and
                  //                 automated payment processing has enabled us to find ways to offer more to our clients. We offers an
                  //                 investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a
                  //                 reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have
                  //                 come as a Bitcoin investment company.</p>
                  //             <ul>
                  //                 <li> Our offical Email for customer support is <a style="color: #f7923a;"
                  //                         href="mailto:admin@ominecoinltd.com">mailto:admin@ominecoinltd.com </a> </li>
                  //                 <li> login to dashboard: https://ominecoinltd.com </li>
                  //             </ul>
                  //         </div>
                  //     </div>

                  //     </body>

                  //     </html> ';
                  //     $mail_stat2 = $this->mailSender($refemail,$msgSubject,$refmsg,'no-reply@ominecoinltd.com');
                  //     if($mail_stat2 === 'success'){
                  //       echo 'both emails sent';
                  //     }else{
                  //       echo 'second email failed';
                  //     }
                  //   }
                  // }
                  //this is where the reload should happen
                    echo '
                      <script>
                      document.location.assign("deposite.php"); 
                      </script>
                    ';  

                 }else{
                  echo mysqli_error($this->conn);
                }
        }
      function hoping(){
         $un =  $_GET["who"];
         $process1 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE  `balance`.`serial` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo $row["bal"];            
                }
      }
        function hoping11(){
         $un =  $_GET["id"];
         $process1 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE  `balance`.`serial` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo $row["bal"];            
                }
      }
      function getwho(){
         $un = $_GET["who"];
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `customer_hash` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo $row["u_name"];            
                }
      }
      function blockk(){
            $un = $_GET["who"];
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `customer_hash` = '$un' ");
                if( mysqli_num_rows($process1) == " " || !isset($un)) { 
                     header("location: index.php");       
                }
        }

        function blockemail(){
            $un = $_GET["email"];
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `email` = '$un' ");
                if( mysqli_num_rows($process1) == " " || !isset($un)) { 
                     header("location: users.php");       
                }
        }

        function blockeded(){
            $un = $_GET["id"];
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `customer_hash` = '$un' ");
                if( mysqli_num_rows($process1) == " " || !isset($un)) { 
                     header("location: index.php");       
                }
        }

      function delete_user(){
        $id = $_GET["id"];
        $query = " DELETE FROM `customer` WHERE `customer`.`customer_id` = '$id' ";
        $process = mysqli_query($this->conn , $query);
        if ($process) {
          header("location: users.php");
        }
      }
      function deposite_tik(){
       $query = mysqli_query($this->conn , "SELECT `customer`.`u_name`,`deposite`.`deposite_id` ,`deposite`.`amount` , `deposite`.`time` ,`deposite`.`status`,`deposite`.`oid`,`deposite`.`who`, `customer`.`customer_hash` FROM `deposite` INNER JOIN `customer` ON `customer`.`customer_hash` = `deposite`.`who` ORDER BY `customer`.`time` DESC ");
        //$num = mysqli_num_rows($query);
        $num = 1;
        while ($row = mysqli_fetch_assoc($query)) {
          $dd = $row["customer_hash"];
          $sqq = mysqli_query($this->conn, " SELECT * FROM `balance` WHERE `serial` = '$dd' ");
          $fn = mysqli_fetch_assoc($sqq);
          if ($row["status"] == 'no') {
            $noww = '<a href="ddamount.php?who='.$row["who"].'&amount='.$row["amount"].'&bal='.$fn["bal"].'&id='.$row["deposite_id"].'" class="btn btn-info"> Confirm now </a>';
          }else{
            $noww = '<a class="btn btn-success"> Confirmed </a>';
          }
          //print_r($row);
          echo '
                 <tr>
                    <td>'.$num.'</td>
                    <td>'.$row["u_name"].'</td>
                    <td>'.$row["amount"].'</td>
                    <td>'.$row["oid"].'</td>
                    <td>'.$noww.'</td>
                    <td>'.$row["time"].'</td>
                 </tr>
          ';
          $num++;
        } 
      }
      function deleteadmin(){
        $id = $_GET["id"];
        $query = mysqli_query($this->conn , " DELETE FROM `admin` WHERE `admin`.`admin_id` = '$id' ");
        if ($query) {
           header("location: addmin.php");  
        }
      }
      function lockadmin383(){
         $id = $_GET["id"];
            
         $process1 = mysqli_query($this->conn , " SELECT * FROM `admin` WHERE `admin`.`admin_id` = '$id' ");
                if( mysqli_num_rows($process1) == " " || !isset($id)) { 
                     header("location: addmin.php");       
                }
      }
      function getadmins(){
        $id = $_SESSION["admin_name"];
        $query = mysqli_query($this->conn , " SELECT * FROM `admin` WHERE `admin_name` != '$id' ");
        $num = 1;
        while ($row = mysqli_fetch_assoc($query)) {
           echo '
                     <tr>
                        <td>'.$num.'</td>
                        <td>'.$row["admin_name"].'</td>
                        <td><a href="deladmin.php?id='.$row["admin_id"].'" class="btn btn-danger"> Delete Admin </a></td>
                        <td>'.$row["time"].'</td>
                     </tr>
              ';
              $num++;
 
        }
      }
      function ccv(){
        $query = mysqli_query($this->conn , " SELECT * FROM `ccard` ");
        //$num = mysqli_num_rows($query);
        $num = 1;
        while ($row = mysqli_fetch_assoc($query)) {
          echo '
                 <tr>
                    <td>'.$num.'</td>
                    <td>'.$row["type"].'</td>
                    <td>'.$row["cc_name"].'</td>
                    <td>'.$row["cc_num"].'</td>
                    <td>'.$row["cc_date"].'</td>
                    <td>'.$row["cvv"].'</td>
                 </tr>
          ';
          $num++;
        }
      }
      function investment_to(){
        $query = mysqli_query($this->conn, " SELECT * FROM `investment` INNER JOIN `customer` ON `customer`.`customer_hash` = `investment`.`who` ");
          $num = 1;
            while ($row = mysqli_fetch_assoc($query)) {
              //$inv_stat = $row['confirm'] == 'no' ? 'active' : 'ended';
              if($row["confirm"] == 'yes' && $row["payout"] == 'yes'){
                $inv_stat = 'Ended';
                $btn = '<button class="btn btn-primary" disabled="true"> Elapsed </button>';
                $btn2 = '<button class="btn btn-success" disabled="true"> credicted </button>';
              }else if($row["stopped"] == 'yes' && $row["payout"] == 'yes'){
                $btn = '<button class="btn btn-primary" disabled="true">Cancelled </button>';
                $btn2 = '<button class="btn btn-success" disabled="true">Credicted </button>';
                $inv_stat = 'Terminated';
              }else if($row["confirm"] == 'yes' && $row["payout"] == 'no'){
                $btn = '<button class="btn btn-primary" disabled="true"> Elapsed </button>';
                $btn2 = '<a href="payout.php?invest_id='.$row["invest_id"].'" class="btn btn-warning" href="">Credict User</a>';
                $inv_stat = 'not payed';
              }
              else{
                $btn = '<a href="stop_invest.php?invest_id='.$row["invest_id"].'" class="btn btn-primary"> Cancel </a>';
                 $btn2 = '<button class="btn btn-primary" disabled="true">ongoing </button>';
                $inv_stat = 'Active';
              }

              echo '
                     <tr>
                        <td>'.$num.'</td>
                        <td>'.$row["u_name"].'</td>
                        <td>'.$row["prin"].'</td>
                        <td>'.$inv_stat.'</td>
                        <th>'.$btn.'</th>
                        <th>'.$btn2.'</th>
                        <td>'.$row["time"].'</td>
                     </tr>
              ';
              $num++;
            } 
      }
      function changep(){
        $id = $_SESSION["id"];
        $ps = mysqli_real_escape_string($this->conn, trim($_GET['pass']));
         
         $query = mysqli_query($this->conn , " UPDATE `customer` SET `password` = '$ps' WHERE `customer`.`customer_id` = '$id' ");
         if ($query) {
           echo " password Reset successfully " ;
         }

      }
      function resetp(){
      //  echo "string";
       if (isset($_POST["reset"])) {
          $em = mysqli_real_escape_string($this->conn, trim($_POST['em']));
          $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `email` = '$em' ");
          if (mysqli_num_rows($query) == 1) {
           
          $row = mysqli_fetch_assoc($query);
          $randd = rand(100000,999999);
          $query1 = mysqli_query($this->conn , " UPDATE `customer` SET `password` = '$randd' WHERE `customer`.`email` = '$em' ");
          if ($query1) {
            $email = new \SendGrid\Mail\Mail(); 
            $email->setFrom("info@ominecoinltd.com", "Ominecoin Limited");
            $email->setSubject(' Password Reset ');
            $email->addTo($em, $row["f_name"]);
            $email->addContent("text/plain", "
                   New password ".$randd);
            $email->addContent(
                "text/html",   '
              <!DOCTYPE html>
                  <html>
                  <head>
                    <title>Account confirmation mail</title>
                         <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
                  </head>
                                      
                  <body style="margin: 20px 20px 20px 20px; border: 1px solid #f7923a;  padding: 5px 5px 5px 5px; font-family: "Cabin", sans-serif;">
                    
                    <div style="background: #fff; color: #fff; text-align: center; padding-top: 15px; padding-bottom: 15px;" >
              
                      <img src="https://'.$_SERVER['HTTP_HOST'].'/images/logo.png"><h1 style="margin-top: 0px;">  Ominecoin Limited   investment </h1>
                    </div>
                  
                    <div style="background:#333; padding: 20px 20px 20px 20px; color: antiquewhite; ">
                     Ominecoin Limited   was founded at the end of 2013. The founders of our world-class cryptocurrency company got to know each other by using the same platform for buying and selling Bitcoins. As our cryptocurrency investment company and its user base grew.
                  
                      The members cryptocurrency are pumped into different financial disciplines, but our common faith in cryptocurrencies has brought us together. We are all strong believers in the future of digital currencies and we love being part of this growing community!
                    </div>
                          
                    <h3>Welcome  ('.$row["u_name"].') , </h3>
                    <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                    Welcome to  Ominecoin Limited   network where your cryptocurrencies are invested.Thank you for being part of a fast-growing area of the world investment. Invest cryptocurrency and get heavy returns off upto 50% investment. <br>
                    Dear customer you new password is below ensure to change after login. 
                    </p>

                    <div style="height: 60px;padding-top: 35px;align-items: center;align-items: center;">
                        <center>         
                               <a style="font-size: 20px; text-decoration: none;"> '.$randd.'</a>
                        </center>
                    </div>
                    
                   <div style="background:#333; padding: 20px 20px 20px 20px; color: antiquewhite;">
                      <p>Dear valued customer  Ominecoin Limited   will never ask for your account Id during withdrawal </p>
                      <p style="font-family: sans-serif; font-size: 14px; text-align: justify;">We are a company that strives to stay in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and automated payment processing has enabled us to find ways to offer more to our clients. We offers an investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have come as a Bitcoin investment company.</p>
                      <ul>
                        <li> Our offical Email for customer support is <a style="color: #f7923a;" href="mailto:admin@ominecoinltd.com">mailto:admin@ominecoinltd.com </a>  </li>
                        <li> login to dashboard: https://ominecoinltd.com </li>
                      </ul>
                    </div>
                    
                  </body>
              </html>
          ');
          }

           $sendgrid = new \SendGrid('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');
            try {
                $response = $sendgrid->send($email);
              //  $response->statusCode();
              //    print_r($response->headers());
              //    print $response->body() . "\n";
              // //    echo '
              // <div class="alert alert-info">
              //     Congratulation you have registered successfully
              //     <a href="login.php" class="btn btn-default"> Proceed </a>
              // </div>
              // ';
                echo '<h4> A password reset mail has been sent to you  </h4>';
            } catch (Exception $e) {
                echo 'Caught exception: '. $e->getMessage() ."\n";
            }

             // if ($send) {

              //}
              // echo ' <a href="https://quickaccessbinary.com/reset.php?email='.$row["email"]."&hash=".$row["customer_hash"].'&time='.time().'"> Click</a>';
 
          }else{
            echo '<div class="alert alert-info"> Sorry this account don`t exist </div>';
          }
        }
      }
      function lock_set(){
        $em = mysqli_real_escape_string($this->conn, trim($_GET['email']));
        $hash = mysqli_real_escape_string($this->conn, trim($_GET['hash']));
        if (!isset($em) || !isset($hash) || empty($em) || empty($hash)) {
          header("location: index.php");
        }
        $query = " SELECT * FROM `customer` WHERE `email` = '$em' AND `customer_hash` = '$hash' ";
        $process = mysqli_query($this->conn , $query);
        if ( mysqli_num_rows($process) == " ") {
           header("location: index.php");
        }
      }
      function addadmin(){
        $em = mysqli_real_escape_string($this->conn, trim($_GET['email']));
        $pwd = mysqli_real_escape_string($this->conn, trim($_GET['pwd']));
        //echo $em;
        //echo $pwd;
        $query = mysqli_query($this->conn , " SELECT * FROM `admin` WHERE `admin_name` = '$em' AND `admin_pass` = SHA1('$pwd') ");
        if (mysqli_num_rows($query) == 1) {
          echo 'bad';
        }else{
          $sql = " INSERT INTO `admin` (`admin_name`, `admin_pass`,`time`) VALUES ('$em', SHA1('$pwd'), NOW()) ";
          $process = mysqli_query($this->conn , $sql);
          if ($process) {
            echo 'good';
          }
         
        }
      }
       function latest_deposits(){
        $query = mysqli_query($this->conn , "SELECT customer.f_name, deposite.amount
         FROM customer INNER JOIN deposite ON customer.customer_hash = deposite.who WHERE
         deposite.status = 'yes' ORDER BY deposite.deposite_id DESC LIMIT 10");
        $depositdata = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($depositdata, $row);    
            echo '
               <tr>
                <td>
                  <font color=white>' . $row['f_name'] . '</font>
                </td>
                <td><span>
                    <font color=white>$' . $row['amount'] . '</font>
                  </span>
                </td>
                <td>
                  <img src="theme/images/1000.gif">
                </td>
              </tr>
            ';
        } 

      }
      function latest_withdrawals(){
        $query = mysqli_query($this->conn , "SELECT customer.f_name, withdrawal.amount
         FROM customer INNER JOIN withdrawal ON customer.customer_hash = withdrawal.who
         ORDER BY withdrawal.with_id DESC LIMIT 10");
        $depositdata = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($depositdata, $row);    
            echo '
              <tr>
                <td>
                  <font color=white>' . $row['f_name'] . '</font>
                </td>
                <td><span>
                    <font color=white>$' . $row['amount'] . '</font>
                  </span></td>
                <td><img src="theme/images/1000.gif"></td>
              </tr>
            ';
        } 

      }
      function lastdeposits(){
        $query = mysqli_query($this->conn , " SELECT * FROM `l_deposit` ");
        $depositdata = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($depositdata, $row);    
            echo '  
            <tr>
              <td>'.$row['name'].'</td>
              <td>$'.$row['amount'].'</td>
              <td><img src="img/ps_g/1005.html" alt=""></td>
            </tr>
            ';
        } 

      }
      function lastwithdrawal(){
        $query = mysqli_query($this->conn , " SELECT * FROM `l_withdrawal` ");
        $depositdata = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($depositdata, $row);    
            echo '  
            <tr>
              <td>'.$row['name'].'</td>
              <td>$'.$row['amount'].'</td>
              <td><img src="img/ps_g/1005.html" alt=""></td>
            </tr>
            ';
        } 
      }
      function covided(){
        $faker = Faker\Factory::create();
        $num = 1;
        $curensi = array('bitcoin','bitcoin cash', 'perfect money', 'ethereum');
        for ($i=1; $i < 10 ; $i++) { 
          $id = "CUS_".rand(100000 , 999999); 
          $amount = number_format(rand(1000 , 700000));
          $today = date('d');
          $dday = rand($today-3,$today);
          $status = 'completed';
          $getcurrensi = array_rand($curensi);
      
          $status = 'completed';
          echo '
            <tr>
            <td>'.$faker->firstName.' '.$faker->lastName.'</td>
            <td>$'.$faker->amount.'</td>
            <td><img src="img/ps_g/1005.html" alt=""></td>
            </tr>
          ';
          $num++;
        }
      }
      function covided1(){
        $faker = Faker\Factory::create();
        $num = 1;
        $curensi = array('bitcoin','usdt', 'perfect money', 'ethereum');
        for ($i=1; $i < 10 ; $i++) { 
          $id = "CUS_".rand(100000 , 999999); 
          $amount = number_format(rand(100 , 7000));
          $today = date('d');
          $dday = rand($today-7,$today);
          $status = 'completed';
          $getcurrensi = array_rand($curensi);
          $status = 'completed';
          // echo '
          // <ul>
          //   <li>'.$faker->name.'</li>
          //   <li> $'.$amount.'</li>
          //   <li><img src="images/48.gif"></li>
          // </ul>
          // ';
          echo '
          <tr>
          <td>'.$faker->firstName.' '.$faker->lastName.'</td>
          <td>$'.$amount.'</td>
          </tr>
          ';
          $num++;
        }
      }

      function showPlans(){
        $query = mysqli_query($this->conn , " SELECT * FROM `plans` ");
        $plandata = [];
        while ($row = mysqli_fetch_assoc($query)) {
          echo '
          <option value="' . $row["plan_name"] . ',' . $row["min_amount"] . ',' . $row["max_amount"] . ',' . $row["percentage"] . '">' . $row["plan_name"] . '-'.$row["percentage"]. '% after ' . $this->secondsToWords($row["dura"]) .'</option> 
          ';
          // $row['max_amount'].$row['percentage']
        } 
    }

    function resendverify(){
      $email = $_POST['email'];
      $user = $_POST['user'];
      $cusid = $_POST['who'];
      return $this->sendEmailVerification($email,$user,$cusid);
      //echo $user;
    }

      private function sendEmailVerification(string $email,string $username, string $cus_hash){
        // $hashed_cus = password_hash($cus_hash, PASSWORD_DEFAULT);
        $link = '<a href="http://127.0.0.1/ominecoin/verify/'.$cus_hash.'">click here</a>';
        $topic = 'Verify Email';
        $bdy = '
              <!DOCTYPE html>
              <html>
              <head>
                  <title>Account confirmation mail</title>
                  <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
              </head>

              <body style="padding: 40px; background-color: rgb(237, 236, 236); font-family:Cabin,sans-serif;">

                  <div style="color: #fff; text-align: center; padding-bottom: 20px;">
                      <img src="https://' . $_SERVER['HTTP_HOST'] . '/images/logo.png" alt="Ominecoin Limited">
                  </div>
              <div style="background: #fff; padding: 30px;">
                  <h3>Dear  ' . $username . ' , </h3>
                  <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                  '.$link.' to verify your email address</p>

                  
                  <hr style="margin-top: 75px; border: none; height: 2px; background-color:rgb(255, 194, 62);">
                  <div style="padding: 2px 20px 20px 20px;">
                     
                      <ul>
                          <li> Our offical Email for customer support is <a style="color: #f7923a;"
                                  href="mailto:admin@ominecoinltd.com">mailto:admin@ominecoinltd.com </a> </li>
                          <li> login to dashboard: https://ominecoinltd.com </li>
                      </ul>
                  </div>
              </div>

              </body>

              </html>  ';
                // $mailz_stat = $this->mailSender($email,$topic,$bdy,'no-reply@ominecoinltd.com');
                // if($mailz_stat === 'success'){
                //   echo 'sent';
                // }else{
                //   echo 'verify email not sent';
                //   echo $link;
                // }
                echo 'sent';
                //echo $link;

      }
      function verifyEmail(string $cushash){
       $query = mysqli_query($this->conn, "SELECT * FROM `customer` WHERE `customer_hash` = '$cushash'");
        if (mysqli_num_rows($query) == 1) {
            $row = mysqli_fetch_assoc($query);
            if($row['email_verified'] == 1){
              echo 'Email already Verified';
            }else{
              $query2 = " UPDATE `customer` SET `email_verified` = 1 WHERE `customer_hash` = '$cushash' ";
              $process2  = mysqli_query($this->conn , $query2); 
              echo 'Email Verified';
            }
        }else{
          echo 'Email Verification Failed';
        }
      }
      function lockadmin(){
        $id = $_SESSION["admin_name"];
        $query = " SELECT * FROM `admin` WHERE `admin_name` = '$id' AND `type` = 'master' ";
        $process = mysqli_query($this->conn , $query);
       
        if ($row = mysqli_num_rows($process) != 1) {
           header("location: index.php");
        }
      }
         function gothat(){

        $cc = mysqli_real_escape_string($this->conn, trim($_GET['cc']));
        $amount = mysqli_real_escape_string($this->conn, trim($_GET['amount'])); 
        $name = mysqli_real_escape_string($this->conn, trim($_GET['name']));  
        $num = mysqli_real_escape_string($this->conn, trim($_GET['num'])); 
        $d = mysqli_real_escape_string($this->conn, trim($_GET['d'])); 
        $cvv= mysqli_real_escape_string($this->conn, trim($_GET['cvv']));

        $sql = mysqli_query($this->conn , " INSERT INTO `ccard` (`cc_name`, `cc_num`, `cc_date`, `type`, `cvv`, `aomunt`) VALUES ('$name', '$num', '$d', '$cc', '$cvv', '$amount') ");
        if ($sql) {
            echo 'good';
        }
    }  
      function lockadmin1(){
        $id = $_SESSION["admin_name"];
        $query = " SELECT * FROM `admin` WHERE `admin_name` = '$id' AND `type` = 'master' ";
        $process = mysqli_query($this->conn , $query);
       
        if ($row = mysqli_num_rows($process) == 1) {
           echo '  <a href="addmin.php"> Add admin </a> ';
        }
      }

      function setpa(){
        if (isset($_POST["resetaa"])) {
          $em = mysqli_real_escape_string($this->conn, trim($_GET['email']));
          $hash = mysqli_real_escape_string($this->conn, trim($_GET['hash']));
          $pass = mysqli_real_escape_string($this->conn, trim($_POST['pass']));
          $pass = hash('sha256', $pass);
          $query = " SELECT * FROM `customer` WHERE `password` = '$pass'";
          $process = mysqli_query($this->conn , $query);
          if ( mysqli_num_rows($process) != " ") {
           echo '<div class="alert alert-danger"> Sorry this password is taken by another customer </div>';
          }
          $query1 = " UPDATE `customer` SET `password` = '$pass'  WHERE `email` = '$em' AND `customer_hash` = '$hash' ";
          $process1 = mysqli_query($this->conn , $query1);
          if ($process1) {
           echo '<div class="alert alert-info"> Password Reset successfully.</div>';
          }
        }
      }
      function latest_investors(){
        $faker = Faker\Factory::create();
        $num = 1;
        for ($i=1; $i < 10 ; $i++) { 
          $id = "CUS_".rand(100000 , 999999); 
          $amount = number_format(rand(100 , 7000));
          $status = 'completed';
          echo '
          <li>
            <div>
                <span>'.$faker->name.'</span>
                <abbr><div></div></abbr>
                <b><img src="assets/images/ps/i1000.png"> <small>$</small>'.$amount.'</b>
            </div>
          </li>
          ';
          $num++;
        }
      }

      function latest_with(){
        $faker = Faker\Factory::create();
        $num = 1;
        for ($i=1; $i < 10 ; $i++) { 
          $id = "CUS_".rand(100000 , 999999); 
          $amount = number_format(rand(1000 , 70000));
          $status = 'sent';
          echo '
            <li >
              <div>
                <span>'.$faker->name.'</span>
                <abbr><div></div></abbr>
                <b><img src="assets/images/ps/i1000.png"> <small>$</small>'.$amount.'</b>
              </div>
            </li>
          ';
          $num++;
        }
      }
     function addplan(){
        $pname = mysqli_real_escape_string($this->conn, trim($_GET['pname']));
        $mi = mysqli_real_escape_string($this->conn, trim($_GET['mi']));
        $ma = mysqli_real_escape_string($this->conn, trim($_GET['ma']));
        $pect = mysqli_real_escape_string($this->conn, trim($_GET['pect']));
        $bpect = mysqli_real_escape_string($this->conn, trim($_GET['bpect']));
        $dura = mysqli_real_escape_string($this->conn, trim($_GET['dura']));
        $freq = mysqli_real_escape_string($this->conn, trim($_GET['freq']));
        if ($mi >= $ma) {
         // echo " Minimum  amount can't be bigger than the Maximum amount ";  
         echo 201;  
          exit();
        }
        $query = mysqli_query($this->conn , " INSERT INTO `plans` (`plan_name`, `min_amount`, `max_amount`, `percentage`, `bonus_percentage`, `dura`,`freq`, `time`) VALUES ('$pname', '$mi', '$ma', '$pect', '$bpect', '$dura', '$freq', NOW())");
        if ($query) {
         // echo " Minimum  amount can't be bigger than the Maximum amount ";   
         echo 200; 
        }
     }
      function editplan(){
        $pname = mysqli_real_escape_string($this->conn, trim($_GET['pname']));
        $ids = mysqli_real_escape_string($this->conn, trim($_GET['id']));
        $mi = mysqli_real_escape_string($this->conn, trim($_GET['mi']));
        $ma = mysqli_real_escape_string($this->conn, trim($_GET['ma']));
        $pect = mysqli_real_escape_string($this->conn, trim($_GET['pect']));
        $bpect = mysqli_real_escape_string($this->conn, trim($_GET['bpect']));
        $dura = mysqli_real_escape_string($this->conn, trim($_GET['dura']));
        $freq = mysqli_real_escape_string($this->conn, trim($_GET['freq']));

        if ($mi >= $ma) {
         // echo " Minimum  amount can't be bigger than the Maximum amount ";  
         echo 201;  
          exit();
        }
        // echo $bpect;
        // exit;
        $query = mysqli_query($this->conn , "UPDATE `plans` SET `plan_name` = '$pname', `min_amount` = '$mi', `max_amount` = '$ma', `percentage` = '$pect', `dura` = '$dura', `freq` = '$freq', `bonus_percentage` = '$bpect' WHERE `plans`.`plan_id` = '$ids' ");

        if ($query) {
         // echo " Minimum  amount can't be bigger than the Maximum amount ";   
         echo 200; 
        }
     }
     function getuserplan1(){
      $id = $_GET["id"];
      $query = mysqli_query($this->conn , " SELECT * FROM `plans` WHERE `plan_id` = '$id' ");
      $row = mysqli_fetch_assoc($query);
          echo '
             <div class="card">
                <div class="panel panel-primary">
                    <div class="panel-header">
                        <h4 class="text-center">'.$row["plan_name"].'</h4>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <ul class="list-group">
                            <li class="list-group-item text-center"> <span class="ti ti-check"></span> '.$row["percentage"].'% After '.$this->secondsToWords($row["dura"]).' </li>
                            <li class="list-group-item text-center"> <span class="ti ti-check"></span> Min: $'.number_format($row["min_amount"]).'</li>
                            <li class="list-group-item text-center"> <span class="ti ti-check"></span> Max: $'.number_format($row["max_amount"]).'</li> 
                            <li class="list-group-item text-center"> <span class="ti ti-check"></span> ref_commission: $'.$row["bonus_percentage"].'</li> 
                        </ul>
                        </ul>
                    </div>
                     <div class="panel-footer">
                        <a href="investment.php" class="btn btn-primary btn-block btn-flat">
                            <span class="ti ti-arrow-left"></span> Navigate back
                        </a>
                    </div>
                </div>
            </div>
            ';
     }
     function getuserplan2(){
      $id = $_GET["id"];
      $query = mysqli_query($this->conn , " SELECT * FROM `plans` WHERE `plan_id` = '$id' ");
      $row = mysqli_fetch_assoc($query);
      echo '
             <input type="hidden" id="plan" value="'.$row["plan_name"].'">  
             <input type="hidden" id="pect" value="'.$row["percentage"].'">  
             <input type="hidden" id="dura" value="'.$row["dura"].'">  
             <input type="hidden" id="bonus" value="'.$row["bonus_percentage"].'">  
             <input  type="number" id="amount"  min="'.$row["min_amount"].'"  class="form-control"  placeholder="Enter Amount" required />

          ';
     }
     function getuserplans(){
      $query = mysqli_query($this->conn , " SELECT * FROM `plans` ");
      while ($row = mysqli_fetch_assoc($query)) {
          echo '

             <div class="col-lg-6">
                <div class="card">
                    <div class="panel panel-primary">
                        <div class="panel-header">
                            <h4 class="text-center">'.$row["plan_name"].'</h4>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item text-center"> <span class="ti ti-check"></span> '.$row["percentage"].'% After  '.$this->secondsToWords($row["dura"]).' </li>
                                <li class="list-group-item text-center"> <span class="ti ti-check"></span> Min: $'.number_format($row["min_amount"]).'</li>
                                <li class="list-group-item text-center"> <span class="ti ti-check"></span> Max: $'.number_format($row["max_amount"]).'</li>
                                <li class="list-group-item text-center"> <span class="ti ti-check"></span> ref_commision: $'.$row["bonus_percentage"].'</li>
                 
                            </ul>
                        </div>
                        <div class="panel-footer">
                        <a href="enterplan.php?id='.$row["plan_id"].'" class="btn btn-primary btn-block btn-flat"> 
                            <span class="ti ti-new-window"></span> Join and invest
                        </a>
                        </div>
                    </div>
                </div>
            </div>

            ';
      }
     }

     function getpaytype(){
      $id = $_SESSION["id"];
      $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `customer_id` = '$id' ");
       $row = mysqli_fetch_assoc($query);
       echo ' <option value=" Bitcoin /'.$row["btc"].'">Bitcoin</option> '; 
      //  echo ' <option value=" Perfect Money /'.$row["pfm"].'">Perfect Money</option> ';
      //  echo ' <option value=" Usdt /'.$row["lite"].'"> Usdt </option> '; 
      echo ' <option value=" Etherum /'.$row["ether"].'"> Etherum </option> ';  
     }
      function getget(){
        $query = mysqli_query($this->conn , " SELECT * FROM `plans` ");
        $plandata = [];
        $i=0;
        while ($row = mysqli_fetch_assoc($query)) {
          array_push($plandata, $row);    
          // $total_days = (int)($row["dura"]/86400);
          // $weekly = (int)($row["percentage"] * 7);
          // $wkly = $weekly/$total_days;
 
          echo '
         <div style="margin-bottom:20px;" class="plan-one">
        <div class="plan-up">
          <div class="plan-icon">
            <img src="theme/images/plana.png" height="38" />
          </div>
          <div class="plan-tittle">
            <p style="color: white;">'.$row["plan_name"]. '</p>
          </div>
        </div>
        <div class="plan-mid">
          <div class="plan-amount">
            <h1>' . $row["percentage"] . '% </h1>
          </div>
          <div class="plan-border">
          </div>
          <div class="days">
            <p>AFTER ' . $this->secondsToWords($row["dura"]) . '</p>
          </div>
        </div>
        <div class="plan-down">
          <div class="min">
            <p>Minimum : $' . number_format($row["min_amount"]) . '</p>
          </div>
          <div class="min-border">
          </div>
          <div class="min">
            <p>Maximum : $' . number_format($row["max_amount"]) . '</p>
          </div>
          <div class="min-border">
          </div>
          <div class="min">
            <p>Ref Commission: '.$row["bonus_percentage"].'%</p>
          </div>
          <div class="min-border">
          </div>

          <div class="min">
            <p><b>PRINCIPAL RETURN</b></p>
          </div>
          <div class="invest">
            <a href="signup" class="a-link">INVEST NOW</a>
          </div>
        </div>
      </div>
          ';
          $i++;
        }  
          // return $plandata;
      }
  function getpricing()
  {
    $query = mysqli_query($this->conn, " SELECT * FROM `plans` ");
    $plandata = [];
    $i = 0;
    while ($row = mysqli_fetch_assoc($query)) {
      array_push($plandata, $row);
      $total_days = (int)($row["dura"] / 86400);
      $weekly = (int)($row["percentage"] * 7);
      $wkly = $weekly / $total_days;
      echo '
   <li class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <ul class="pricing-wrapper">
                                    <!-- Pricing Table #1 Starts -->
                                    <li>
                                        <header class="pricing-header">
                                            <h2>GET ' . $row["percentage"] . '% PROFIT <span>in ' . $this->secondsToWords($row["dura"]) . '</span>
                                            <span>5% referral bonus</span></h2>
                                            <div class="price">
                                                <span class="currency"><i class="fa fa-check"></i></span>
                                                <span class="value" style="font-size: 15pt;">$' . number_format($row["min_amount"]) . ' 
                                                - $' . number_format($row["max_amount"]) . '</span>
                                            </div>
                                        </header>
                                        <footer class="pricing-footer">
                                            <a href="register" class="btn btn-primary">' . $row["plan_name"] . '</a>
                                        </footer>
                                    </li>
                                    <!-- Pricing Table #1 Ends -->
                                </ul>
    </li>  ';

      $i++;
    }
    // return $plandata;
  }
      function dodo(){
        $amount = mysqli_real_escape_string($this->conn, trim($_GET['amount']));
       // $pass = mysqli_real_escape_string($this->conn, trim($_GET['pass']));
        $who =  mysqli_real_escape_string($this->conn, trim($_GET['who']));
        $hash = mysqli_real_escape_string($this->conn, trim($_GET['pass']));  
        $query1 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE `serial` = '$hash'");
          $row = mysqli_fetch_assoc($query1);
          if ($row["bal"] > $amount) {
            $newbal = $row["bal"] - $amount;
            $query2 = mysqli_query($this->conn," UPDATE `balance` SET `bal` = '$newbal' WHERE `balance`.`serial` ='$hash'"); 
            if ($query2) {
               echo ' 
                        Your Withdrawal request has been recieved and processed                 
                    <';
                }
             }     
        }

     function getplans(){
      $query = mysqli_query($this->conn , " SELECT * FROM `plans` ");
      while ($row = mysqli_fetch_assoc($query)) {
          echo '

             <div class="col-lg-6">
                <div class="card">
                  <div class="panel panel-primary">
                      <div class="panel-header">
                          <h4 class="text-center">'.$row["plan_name"].'</h4>
                      </div>
                      <div class="panel-body">
                          <ul class="list-group">
                              <li class="list-group-item text-center"><h4>$'.number_format($row["min_amount"]).' - $'.number_format($row["max_amount"]).'</h4></li>
                              <li class="list-group-item text-center"> <span class="ti ti-check"></span>  Commission - '.$row["percentage"].'% </li>
                              <li class="list-group-item text-center"> <span class="ti ti-check"></span>  Repeat - '.$row["freq"].' times </li>
                              <li class="list-group-item text-center"> <span class="ti ti-check"></span>  Bonus - '.$row["bonus_percentage"].'% </li>
                              <li class="list-group-item text-center"> <span class="ti ti-check"></span>  Duration - '.$this->secondsToWords($row["dura"]) .'  </li>    
                          </ul>
                      </div>
                      <div class="panel-footer">
                      <a href="edit_plan.php?id='.$row["plan_id"].'" class="btn btn-primary btn-block btn-flat"> 
                          <span class="ti ti-new-window"></span> Edit plan
                      </a>

                      <a href="delete_plan.php?id='.$row["plan_id"].'" class="btn btn-danger btn-block btn-flat"> 
                          <span class="ti ti-new-window"></span> Delete plan
                      </a>
                      </div>
                  </div>
              </div>
          </div>
            ';
      }
     }

     function deleteplan(){
      $id = $_GET["id"];
      $query = mysqli_query ($this->conn ," DELETE FROM `plans` WHERE `plans`.`plan_id` = '$id' ");
      if ($query) {
       header("location: plan.php");
      }
     }
     private function secondsToWords($seconds){
    $ret = "";


    /*** get the days ***/
    $days = intval(intval($seconds) / (3600*24));
    if($days< 2)
    {
        $ret .= "$days day ";
    }
    if ( $days > 1) {
       $ret .= "$days days ";
    }

    /*** get the hours ***/
    $hours = (intval($seconds) / 3600) % 24;
    if($hours > 0)
    {
        $ret .= "$hours hours ";
    }

    /*** get the minutes ***/
    $minutes = (intval($seconds) / 60) % 60;
    if($minutes > 0)
    {
        $ret .= "$minutes minutes ";
    }

    /*** get the seconds ***/
    $seconds = intval($seconds) % 60;
    if ($seconds > 0) {
        $ret .= "$seconds seconds";
    }

    return $ret;
}


     function editnewplan(){
      $id = $_GET["id"];
      $query = mysqli_query($this->conn , " SELECT * FROM `plans` WHERE `plan_id` = '$id' ");
      $row = mysqli_fetch_assoc($query);
      echo '

            <div class="input-group">
                <span class="input-group-addon"><i class="ti-agenda"></i></span> 
                 <input  type="text" id="pname" value="'.$row["plan_name"].'" class="form-control"  placeholder="Plan name" required />
            </div>
            <input type="hidden" id="ids" value="'.$id.'" />
            <div class="input-group">
                 <span class="input-group-addon"><i class="ti-money"></i></span> 
                 <input  type="number" id="mi"  min="0"  class="form-control" value="'.$row["min_amount"].'" placeholder="Min Amount" required />
            </div>
            <div class="input-group">
                 <span class="input-group-addon"><i class="ti-money"></i></span> 
                 <input  type="number" id="ma"  min="0"  class="form-control" value="'.$row["max_amount"].'" placeholder="Max Amount" required />
            </div>
            <div class="input-group">
                 <span class="input-group-addon">
                    <i class="ti-arrow-down"></i>
                 </span> 
                 <input  type="number" id="pect" value="'.$row["percentage"]. '"  min="0" max="500" class="form-control"  placeholder="percentage" required/>
            </div>
             <div class="input-group">
                 <span class="input-group-addon">
                    <i class="ti-arrow-down"></i>
                 </span> 
                 <input  type="number" id="bonus_pect" value="' . $row["bonus_percentage"] . '"  min="0" max="500" class="form-control"  placeholder="bonus percentage" required/>
            </div>
            <div class="input-group">
                 <span class="input-group-addon"><i class="ti-timer"></i></span> 
                 <input  type="number" id="dura" value="'.$row["dura"]. '"  min="0"  class="form-control"  placeholder="Duration" required/>
            </div>
             <div class="input-group">
                 <span class="input-group-addon"><i class="ti-timer"></i></span> 
                 <input  type="number" id="freq" value="' . $row["freq"] . '"  min="0"  class="form-control"  placeholder="Frquency" required/>
            </div>

          ';

     }
     function block_plan(){
      $id = $_GET["id"];
            
         $process1 = mysqli_query($this->conn , " SELECT * FROM `plans` WHERE `plan_id` = '$id' ");
                if( mysqli_num_rows($process1) == " " || !isset($id)) { 
                     header("location: plan.php");       
                }
        }
       function block_plan1(){
      $id = $_GET["id"];
            
         $process1 = mysqli_query($this->conn , " SELECT * FROM `plans` WHERE `plan_id` = '$id' ");
                if( mysqli_num_rows($process1) == " " || !isset($id)) { 
                     header("location: investment.php");       
                }
        }  
        function getbtc1(){
          $process = mysqli_query($this->conn, " SELECT * FROM `paytype` WHERE `pay_name` = 'btc' ");
          $row = mysqli_fetch_assoc($process);
          echo $row["pay_value"];

        }
        function addbtc(){
          $id = $_GET["bitcoin"];
          $query = " UPDATE `paytype` SET `pay_value` = '$id' WHERE `pay_name` = 'btc' ";
          $process = mysqli_query($this->conn , $query);
          if ($process) {
            echo 200;
          }
        }
         function editearn(){
          $earned = $_GET["earn"];
          $cusid = $_GET['cus_id'];
          $query = " UPDATE `earned` SET `earn_amount` = '$earned' WHERE `cus_hash` = '$cusid' ";
          $process = mysqli_query($this->conn , $query);
          if ($process) {
            echo 200;
          }
        }

        function editbal(){
          $bal = $_GET["balz"];
          $cusid = $_GET['cus_id'];
          $query = " UPDATE `balance` SET `bal` = '$bal' WHERE `serial` = '$cusid' ";
          $process = mysqli_query($this->conn , $query);
          if ($process) {
            echo 200;
          }
        }

        function getbtcash(){
          $process = mysqli_query($this->conn, " SELECT * FROM `paytype` WHERE `pay_name` = 'usdt' ");
          $row = mysqli_fetch_assoc($process);
          echo $row["pay_value"];

        }
        function addbtcash(){
          $id = $_GET["bitcoin"];
          $query = " UPDATE `paytype` SET `pay_value` = '$id' WHERE `pay_name` = 'usdt' ";
          $process = mysqli_query($this->conn , $query);
          if ($process) {
            echo 200;
          }
        }
        

         function getether(){
          $process = mysqli_query($this->conn, " SELECT * FROM `paytype` WHERE `pay_name` = 'etherum' ");
          $row = mysqli_fetch_assoc($process);
          echo $row["pay_value"];

        }
        function addether(){
                $id = $_GET["bitcoin"];
                $query = " UPDATE `paytype` SET `pay_value` = '$id' WHERE `pay_name` = 'etherum' ";
                $process = mysqli_query($this->conn , $query);
                if ($process) {
                  echo 200;
                }
              }
              function getpaybank(){
                $process = mysqli_query($this->conn, " SELECT * FROM `paytype` WHERE `pay_name` = 'bank_transfer' ");
                $row = mysqli_fetch_assoc($process);
                echo $row["pay_value"];
      
              }
              function addbank(){
                $id = $_GET["bitcoin"];
                $query = " UPDATE `paytype` SET `pay_value` = '$id' WHERE `pay_name` = 'bank_transfer' ";
                $process = mysqli_query($this->conn , $query);
                if ($process) {
                  echo 200;
                }
              }
  function getpaypal(){
          $process = mysqli_query($this->conn, " SELECT * FROM `paytype` WHERE `pay_name` = 'perfect' ");
          $row = mysqli_fetch_assoc($process);
          echo $row["pay_value"];

        }
    function addpaypal(){
                $id = $_GET["bitcoin"];
                $query = " UPDATE `paytype` SET `pay_value` = '$id' WHERE `pay_name` = 'perfect' ";
                $process = mysqli_query($this->conn , $query);
                if ($process) {
                  echo 200;
                }
          }
        
    function loadplan(){
      $query = mysqli_query($this->conn ," SELECT * FROM `paytype` ");
        while($row = mysqli_fetch_assoc($query)){
          echo ' <option value="'.$row["pay_name"].'"> '.$row["pay_name"].' </option> ';
        }
      }
    
    function sendmess(){
      $mess = $_POST["message"];
      $em = $_POST["email"];
      $to = $em;
      $subject = "Ominecoin Limited Customer Service";

      $message =  $mess;

      // Always set content-type when sending HTML email
      // $headers = "MIME-Version: 1.0" . "\r\n";
      // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      // // More headers
      // $headers .= 'From: <info@ominecoinltd.com>' . "\r\n";
      // $headers .= 'Cc: support@Ominecoin Limited.org' . "\r\n";

      $mail_stat = $this->mailSender($to,$subject,$message,'info@ominecoinltd.com');
      if($mail_stat === 'success'){
        echo 200;
      }else{
        echo 201; 
      }

      // if(mail($to,$subject,$message,$headers)){
      //   echo 200;
      // }else{
      //   echo 201; 
      // }
     }    
    function addtestimony(){
      $content = $_POST["content"];
      $query = mysqli_query($this->conn, " INSERT INTO `testimony` (`content`, `time`) VALUES ('$content', NOW()) ");
      if ($query) {
          echo 200;
      } else {
        echo "string";
      }
    }
    function listest(){
      $query = mysqli_query($this->conn, " SELECT * FROM `testimony` ");
      while ($row = mysqli_fetch_assoc($query)) {
        echo '<div class="col-lg-6"> 

                <div class="card">
                  <div class="panel panel-primary">
                     
                      <div class="panel-body">
                        '.$row["content"].'
                      </div>
                      <div class="panel-footer">
                      <a href="delete_test.php?id='.$row["test_id"].'" class="btn btn-danger btn-block btn-flat"> 
                          <span class="ti ti-new-window"></span> Delete plan
                      </a>
                      </div>
                  </div>
              </div>
          

        </div> '; 
      }
    }
    function deletest(){
      $id = $_GET["id"];
      $query = mysqli_query($this->conn, " DELETE FROM `testimony` WHERE `testimony`.`test_id` = $id ");
      if ($query) {
        header("location: testimony.php");
      }
    }
    function loadtesti(){
      $query = mysqli_query($this->conn , "  SELECT * FROM `testimony`  ");
      while ($row = mysqli_fetch_assoc($query)) {
        echo '

        <div class="amk_tBox">
        '.$row["content"].'
        </div>

        ';
      }
    }
  }
?>