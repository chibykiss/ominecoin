<?php
ob_start();
session_start();
if (isset($_SESSION["un"]) && isset($_SESSION["hash"]) && isset($_SESSION["id"])) {
    header("location: customer");
}
require("script.php");
$classObj = new topspin;
$classObj->dbcon();
?>
<!doctype html>
<html lang="en">
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,">
    <title>Signup - Omine Coin Limited</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=1280px">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="TrqCyjMGZKlnj7EU8lXCNm5IscwffLhu4EnUgbLE">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="theme/images/icon.png">

    <link rel="stylesheet" type="text/css" href="theme/css/style.css" />
    <link rel="stylesheet" type="text/css" href="theme/css/jquery.popup.css" />
    <link rel="stylesheet" type="text/css" href="theme/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="theme/css/proof.css" />
    <link rel="stylesheet" type="text/css" href="theme/font-awesome-4.5.0/css/font-awesome.html" />
    <link rel="stylesheet" type="text/css" href="theme/font-awesome-4.5.0/css/font-awesome.min.html" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <script src="theme/js/jquery-1.11.3.min.js"></script>
    <script src="theme/js/wow.js"></script>
    <script src="theme/js/jquery.popup.js"></script>
    <script src="theme/js/calculator.js"></script>
    <script src='../www.google.com/recaptcha/api.js'></script>
    <script src='../www.google.com/recaptcha/apif250.js?render=6LfYwWQfAAAAAJoRK47uvAxk5AR8kUiM7FRJhmAO'></script>

    <script>
        wow = new WOW();
        wow.init();
    </script>
    <script type="text/javascript">
        $(function() {
            $(".js__p_start, .js__p_another_start").simplePopup();
        });
    </script>

    <script type="text/javascript" src="theme/js/tabcontent.js"></script>
    <link rel="stylesheet" type="text/css" href="theme/css/tabcontent.css" />
</head>

<body>


    <div align="center">
        <div id="ytWidget"></div>
        <script src="../translate.yandex.net/website-widget/v1/widget80d6.js?widgetId=ytWidget&amp;pageLang=en&amp;widgetTheme=light&amp;autoMode=false" type="text/javascript"></script>
    </div>


    <div style="height:62px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; block-size:62px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;">
        <div style="height:40px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&amp;theme=light&amp;pref_coin_id=1505&amp;invert_hover=" width="100%" height="36px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div>
        <div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io/" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by Coinlib</div>
    </div>


    <?php $cpage = 'register';
    require_once __DIR__ . '/incs/header.php'; ?>
    <!-- content goes here -->
    <div id="main-state">
        <div id="sub-state">
            <div class="other-head">
                <h3>Create An Account</h3>

            </div>

        </div>

    </div>
    </div>
    <form method="POST" action="">
        <div style="text-align:center;"><?php $classObj->signup(); ?></div><br>
        <div id="main-other">

            <!-- <p style="text-align:center;">stuff here</p> -->
            <div id="sub-other">


                <div class="information-head">

                    <p>Personal Information :</p>
                </div>
                <div class="information-all">
                    <div class="information-one">
                        <div class="information-tittle">
                            <p>Fullname :</p>
                        </div>
                        <div class="intype">
                            <input type="text" name="fullname" class="" required />
                        </div>
                    </div>
                    <div class="information-one">
                        <div class="information-tittle">
                            <p>Username :</p>
                        </div>
                        <div class="intype">
                            <input type="text" name="username" class="" required />
                        </div>
                    </div>
                    <div class="information-one">
                        <div class="information-tittle">
                            <p>Email Address :</p>
                        </div>
                        <div class="intype">
                            <input type="email" style='font-size:17px;width: 98%;height:100%;border:none;padding:12px 6px;background-color: #ffffff;color: #000;font-family:Roboto-Regular;outline:none;border:1px solid#aeaeae;' name="em" class="email" required>
                        </div>
                    </div>


                    <div class="information-head">
                        <p>Security Information :</p>
                    </div>

                    <div class="information-one">
                        <div class="information-tittle">
                            <p>Password :</p>
                        </div>
                        <div class="intype">
                            <input type="password" name="pass" class="" required />
                        </div>
                    </div>
                    <div class="information-one">
                        <div class="information-tittle">
                            <p>Retype Password :</p>
                        </div>
                        <div class="intype">
                            <input type="password" name="conpass" class="" required>
                        </div>
                    </div>


                    <div class="information-head">
                        <p>Payment Information :</p>
                    </div>

                    <div class="information-one">
                        <div class="information-tittle">
                            <p>Select Payment type :</p>
                        </div>
                        <div>
                            <select name="method" class="intype">
                                <option value="bitcoin">Bitcoin</option>
                                <option value="ethereum">Ethereum</option>
                            </select>
                            <!-- <input type="text" name="perfect" class="" required /> -->
                        </div>
                    </div>

                    <div class="information-one">
                        <div class="information-tittle">
                            <p>Wallet Address :</p>
                        </div>
                        <div class="intype">
                            <input type="text" name="wallet" class="" required>
                        </div>
                    </div>

                </div>
            </div>

            <div class="check-text">
                <div class="check-box">
                    <input type="checkbox" required name=agree value=1>
                </div>
                <div class="agree">
                    <p>I have read and understood the <span><a href="terms.html"> Rules &amp; Agreement</a></span></p>
                </div>

            </div>



            <div class="regnow">

                <!-- <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" /><br>



                <br> -->

                <input type="submit" name='signup' value="REGISTER NOW">
            </div><br>
            <div>
                <p style="text-align: center;"><a href="login">Registered? Login</a></p>
            </div>
        </div>

    </form>
    </div>
    </div>
    </div><br>
    <!-- content ends here -->

    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LfYwWQfAAAAAJoRK47uvAxk5AR8kUiM7FRJhmAO', {
                    action: 'homepage'
                })
                .then(function(token) {
                    //console.log(token);
                    document.getElementById('g-recaptcha-response').value = token;
                });
        });
    </script>
    <!-- content ends here -->


    <div id="main-payment">
        <div id="sub-payment">
            <div class="payment">
                <ul>
                    <li class="flipInY"><a href="#"><img src="theme/images/perfect.png"></a></li>
                    <li class="flipInY"><a href="#"><img src="theme/images/bitcoin.png"></a></li>
                    <li class="flipInY"><a href="#"><img src="theme/images/payeer.png"></a></li>
                    <!---<li class="flipInY  wow animated" data-wow-duration="2s" data-wow-delay="0.7s" style="visibility: visible; animation-duration: 2s; animation-delay: 0.7s; animation-name: flipInY;"><a href="#"><img src="images/advcash.png"></a></li> ---->
                </ul>
            </div>
        </div>
    </div>




    <?php require_once __DIR__ . '/incs/footer.php'; ?>



</body>

</html>
<?php ob_end_flush(); ?>