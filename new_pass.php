<!doctype html>
<html lang="en">
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <base href="http://127.0.0.1/ominecoin/" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,">
    <title>NewPass - Ominecoin Limited</title>
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
                <h3>Enter your new password</h3>
            </div>
        </div>
    </div>
    </div>
    <div id="main-other">
        <div id="sub-login">
            <?php
            if (isset($_GET['ss']) && isset($_GET['vl'])) {
                if (!empty($_GET['ss']) && !empty($_GET['vl'])) {
                    $selector = $_GET['ss'];
                    $token = $_GET['vl'];
                    if (ctype_xdigit($selector) !== false && ctype_xdigit($token) !== false) {
            ?>
                        <form method="POST" id="resetPasswordForm">
                            <h5 style="text-transform:lowercase;" id="showMessage"></h5>
                            <div style="margin-top:0px;" class="support">

                                <div class="sup-one">
                                    <div class="sup-tittle">
                                        <p>New Password</p>
                                    </div>
                                    <div class="supbox">
                                        <input type="password" class="" name="pwd" placeholder="Enter New Password" required>
                                    </div>
                                </div>
                                <div class="sup-one">
                                    <div class="sup-tittle">
                                        <p>Confirm Password</p>
                                    </div>
                                    <div class="supbox">
                                        <input type="hidden" name="select" value="<?= $selector ?>" />
                                        <input type="hidden" name="validate" value="<?= $token ?>" />
                                        <input type="password" class="" name="rpwd" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                                <div class="forgot-login">
                                    <div class="login-now-">
                                        <input type="submit" name='submit' value="Reset">
                                    </div>
                                </div>
                            </div>
                        </form>
            <?php
                    } else {
                        echo '<h3>invalid url tokens</h3>';
                    }
                } else {
                    echo '<h3>we could not validate your request</h3>';
                }
            } else {
                echo '<h3>not set</h3>';
            }
            ?>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            let resetform = document.getElementById('resetPasswordForm');
            var output = '';
            resetform.addEventListener('submit', function(e) {
                e.preventDefault();
                //alert('you submitted')



                formData = new FormData(resetform);
                fetch('apis/reset_password.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then((res) => res.json())
                    .then((data) => {
                        console.log(data);
                        if (data.error == false) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Your app password has been changed',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function() {
                                window.location.assign('index')
                            }, 1500);
                        } else if (data.error == true) {
                            switch (data.errcode) {
                                case 1:
                                    output += `you did not request for a password reset`;
                                    setTimeout(function() {
                                        window.location.assign('index');
                                    }, 1500);
                                    break;
                                case 2:
                                    output += `your reset link is expired`;
                                    setTimeout(function() {
                                        window.history.back();
                                    }, 1500);
                                    break;
                                case 3:
                                    output += `<span style="color:red;">your token does not match</span>`;
                                    setTimeout(function() {
                                        window.history.back();
                                    }, 1500);
                                    break;
                                case 4:
                                    output += `<span style="color:red;">your password do not match</span>`;
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                    break;
                                case 5:
                                    output += `<span style="color:red;">fill in the missing feild/s</span>`;
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                    break;
                                case 6:
                                    output += `some values were not set`;
                                    setTimeout(function() {
                                        window.location.assign('index');
                                    }, 1500);
                                    break;
                                default:
                                    output += `unkown errors occured`;
                                    setTimeout(function() {
                                        window.location.assign('index');
                                    }, 1500);
                                    break;
                            }
                            $('#showMessage').html(output);
                        } else {
                            console.log('village people error');
                        }

                    })

                // .catch(function(error){
                //     console.log(error)
                // })
                //alert(email);
            });

        });
    </script>

</body>

</html>