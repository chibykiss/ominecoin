<!doctype html>
<html lang="en">
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,">
    <title>Reset - Ominecoin Limited</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=1280px">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="P4wwvuEr2zEBRBAAP2iFetXs7kDXO154r3PHvpYr">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="shortcut icon" href="theme/images/icon.png">
    <link rel="stylesheet" type="text/css" href="theme/css/style.css" />
    <link rel="stylesheet" type="text/css" href="theme/css/jquery.popup.css" />
    <link rel="stylesheet" type="text/css" href="theme/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="theme/css/proof.css" />
    <link rel="stylesheet" type="text/css" href="theme/font-awesome-4-5-0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="theme/font-awesome-4-5-0/css/font-awesome.min.css" />
    <script src="theme/js/jquery-1.11.3.min.js"></script>
    <script src="theme/js/wow.js"></script>
    <script src="theme/js/jquery.popup.js"></script>
    <script src="theme/js/calculator.js"></script>
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


    <?php require_once __DIR__ . '/incs/header.php'; ?>
    <!-- content goes here -->
    <div id="main-state">
        <div id="sub-state">
            <div class="other-head">
                <h3>Forgot your password</h3>
            </div>
        </div>
    </div>
    </div>
    <div id="main-other">
        <div id="sub-login">
            <form method="POST" id="forgotPassword">
                <h5 style="text-transform:lowercase;" id="showMessage"></h5>
                <div style="margin-top:0px;" class="support">

                    <div class="sup-one">
                        <div class="sup-tittle">
                            <p>Email</p>
                        </div>
                        <div class="supbox">
                            <input type="text" class="" name="email" placeholder="Enter your E-mail address" required>
                        </div>
                    </div>
                    <div class="forgot-login">
                        <div class="login-now-">
                            <input type="submit" name='submit' value="Send Now">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
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

    <script>
        $(document).ready(function() {
            let resetform = document.getElementById('forgotPassword');
            var output = '';
            resetform.addEventListener('submit', function(e) {
                e.preventDefault();
                // let email = document.getElementById('pms_username_email').value;


                // alert(msg);
                formData = new FormData(resetform);
                // formData = new FormData();
                // formData.append('email',email);
                fetch('apis/reset_request.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then((res) => res.json())
                    .then((data) => {
                        console.log(data)
                        console.log(data.err_code);
                        if (data.error == false) {
                            output += `<span style="color:green;">reset link successfully sent to your email address</span>`;
                            // setTimeout(function(){ window.history.back(); }, 3000);
                        } else {
                            if (data.err_code == 1) {
                                output += `<span style="color:red;">you are not a registred user</span>`;
                                //setTimeout(function(){ location.reload(); }, 1500);
                            } else if (data.err_code == 2) {
                                output += `<span style="color:red;">Email sending failed</span>`;
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else if (data.err_code == 3) {
                                output += `<span style="color:red;">Email feild cannot be empty</span>`;
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                output += `Unkown error occured`;
                            }

                        }

                        document.getElementById('showMessage').innerHTML = output;
                        $('#showMessage').html(output);
                    })
                    .catch(function(error) {
                        console.log(error)
                    })
            });

        });
    </script>

</body>

</html>