<?php
ob_start();
// session_start();

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
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0,"> -->
  <title>Ominecoin limited</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=1280px">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="FtcQ32GhxFK0LFb2L2mCsenJRN9MF8QCfisEWZcE">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link rel="shortcut icon" href="theme/images/icon.png">
  <link rel="stylesheet" type="text/css" href="theme/css/style.css" />
  <link rel="stylesheet" type="text/css" href="theme/css/jquery.popup.css" />
  <link rel="stylesheet" type="text/css" href="theme/css/animate.css" />
  <link rel="stylesheet" type="text/css" href="theme/css/proof.css" />
  <link rel="stylesheet" type="text/css" href="theme/font-awesome-4-5-0/css/font-awesome.css" />
  <link rel="stylesheet" type="text/css" href="theme/font-awesome-4-5-0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="theme/js/jquery-1.11.3.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
  <script src="theme/js/wow.js"></script>
  <script src="theme/js/jquery.popup.js"></script>
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
    <script src="./translate.yandex.net/website-widget/v1/widget80d6.js?widgetId=ytWidget&amp;pageLang=en&amp;widgetTheme=light&amp;autoMode=false" type="text/javascript"></script>
  </div>


  <div style="height:62px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; block-size:62px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;">
    <div style="height:40px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&amp;theme=light&amp;pref_coin_id=1505&amp;invert_hover=" width="100%" height="36px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div>
    <div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io/" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by Coinlib</div>
  </div>

  <?php
  $cpage = 'index';
  require_once __DIR__ . '/incs/header.php';
  ?>

  <div id="main-slider">
    <div id="sub-slider">
      <div class="slidup">

        <div class="slid-text">
          <div class="make zoomIn animated wow" data-wow-duration="2s" data-wow-delay="0.4s">
            <h1>WELCOME TO Ominecoin Limited</h1>
          </div>
          <div class="invite fadeIn animated wow" data-wow-duration="2s" data-wow-delay="0.4s">
            <p> Invest in a trustworthy & lucrative investment platform for great earnings, believe in Ominecoin Limited, a UK registered company to make your financial desires come true.</p>
          </div>
          <div class="today flash animated wow" data-wow-duration="2s" data-wow-delay="0.4s">
            <a href="signup" class="a-link">Register Today !</a>
          </div>

        </div>
      </div>
    </div>

  </div><br /><br /><br />
  <div id="main-white">
    <div id="sub-white">

      <?php $classObj->getget(); ?>
      <!-- <div class="plan-one">
        <div class="plan-up">
          <div class="plan-icon">
            <img src="theme/images/plana.png" height="38" />
          </div>
          <div class="plan-tittle">
            <p style="color: white;">Basic</p>
          </div>
        </div>
        <div class="plan-mid">
          <div class="plan-amount">
            <h1>20% </h1>
          </div>
          <div class="plan-border">
          </div>
          <div class="days">
            <p>AFTER 24 HOURS</p>
          </div>
        </div>
        <div class="plan-down">
          <div class="min">
            <p>Minimum : $100.00</p>
          </div>
          <div class="min-border">
          </div>
          <div class="min">
            <p>Maximum : $499.00</p>
          </div>
          <div class="min-border">
          </div>
          <div class="min">
            <p>Ref Commission: 5%</p>
          </div>
          <div class="min-border">
          </div>

          <div class="min">
            <p><b>PRINCIPAL RETURN</b></p>
          </div>
          <div class="invest">
            <a href="signup.html" class="a-link">INVEST NOW</a>
          </div>
        </div>
      </div> -->




      <div class="calculator">
        <div class="p_anch"> <a href="#" class="js__p_start"><img src="theme/images/profit.png" /></a></div>
        <div class="p_body js__p_body js__fadeout">
        </div>
        <div class="popup js__popup js__slide_top">
          <div class="cal-head">
            <h4 style="color:#FFFFFF;">SELECT PLAN</h4>
          </div>
          <!-- <div class="allcal">

          </div> -->
          <div class="select">
            <select id="4select">
              <?php $classObj->showPlans();  ?>
            </select>
          </div>
          <div style="color:#FFFFFF;" class="enter-amount">
            <h4>Enter amount</h4>
          </div>
          <div class="amount-type">
            <input id="invest_amount" value="100" type="text" name="text">
          </div>
          <div class="trf">
            <div class="tr">
              <div class="tr-tittle">
                <p>Total Return</p>
              </div>
              <div class="tr-amount">
                <p id="profit_amount">$00.00</p>
              </div>
            </div>
            <!-- <div class="tr">
              <div class="tr-tittle">
                <p>Net Profit</p>
              </div>
              <div class="tr-amount">
                <p id="net_profit">$00.00</p>
              </div>
            </div> -->
          </div>
          <a href="#" class="p_close js__p_close" title="Close"></a>
        </div>
      </div>
    </div>
  </div>
  <div id="main-state-">
    <div id="sub-state-">
      <div class="feture-text">
        <div class="text-one fadeInDown animated wow" data-wow-duration="2s" data-wow-delay="0.4s">
          <p>01<br />
            <span> Professional<br />
              Management Team</span>
          </p>
        </div>
        <div class="text-one fadeInDown animated wow" data-wow-duration="2s" data-wow-delay="0.4s">
          <p>03<br />
            <span> DDOS<br />
              PROTECTED SERVER</span>
          </p>
        </div>
        <div class="text-one fadeInDown animated wow" data-wow-duration="2s" data-wow-delay="0.4s">
          <p>05<br />
            <span> 24/7 FRIENDLY<br />
              CUSTOMER SUPPORT</span>
          </p>
        </div>
      </div>
      <div class="feturebg">
      </div>
      <div class="feture-down">
        <div class="text-three fadeInUp animated wow" data-wow-duration="2s" data-wow-delay="0.4s">
          <p>02<br /><span>LEGAL <br />
              REGISTERED COMPANY</span>
          </p>
        </div>
        <div class="text-three fadeInUp animated wow" data-wow-duration="2s" data-wow-delay="0.4s">
          <p>04<br /><span>COMODO<br />
              SSL Certificate</span>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div id="main-about">
    <div id="sub-about">
      <div class="about-left">
        <div class="about-head">
          <h4>Ominecoin limited</h4>
        </div>
        <div class="about-us">
          <!-- <div class="test-bg zoomIn  wow animated" data-wow-duration="2s" data-wow-delay="0.4s" style="visibility: visible; animation-duration: 2s; animation-delay: 0.4s; animation-name: zoomIn;">
            <img src="theme/images/certificate.jpg" width=300 height=400>
          </div> -->
          <div class="about-text">
            <p>
              Ominecoin limited is a London based international crypto trading company. That has been registered in united kingdom in 2017 at Bristol city. we specialized in primary stock trading, bitcion mining ,debt and investment brokerage and real estate management service to private and institutional investors. Individual and business in distress. The agency operate through a vast network of freelance financial consultants, investment managers, individual traders, venture financiers micro finance institution and other independent contractors <a href="about-us.html"><b>Read more.......</b></a><br /><br />
              <iframe width="900" height="315" src="https://www.youtube.com/embed/2Xg3JHVAog0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </p>
          </div>
        </div>
      </div>
      <div class="about-right">
        <div class="about-head">
          <h4>Steps to Success</h4>
        </div>
        <div class="all-step">
          <div class="step-one fadeInRight animated wow" data-wow-duration="2s" data-wow-delay="0.4s">
            <div class="step-icon">
              <img src="theme/images/open.png" />
            </div>
            <div class="step-text">
              <div class="step-head">
                <h5>OPEN AN ACCOUNT</h5>
              </div>
              <div class="step-textt">
                <p>Click "Join Today" button to become our member after which you will taken to the page.</p>
              </div>
            </div>
          </div>
          <div class="step-one fadeInRight animated wow" data-wow-duration="2s" data-wow-delay="0.6s">
            <div class="step-icon">
              <img src="theme/images/select.png" />
            </div>
            <div class="step-text">
              <div class="step-head">
                <h5>Log In Your Account</h5>
              </div>
              <div class="step-textt">
                <p>Log in your account & click to make a deposit then select the plan.</p>
              </div>
            </div>
          </div>
          <div class="step-one fadeInRight animated wow" data-wow-duration="2s" data-wow-delay="0.8s">
            <div class="step-icon">
              <img src="theme/images/make.png" />
            </div>
            <div class="step-text">
              <div class="step-head">
                <h5>make deposit</h5>
              </div>
              <div class="step-textt">
                <p>Select a plan then select a e-currency and enter deposit amount and click to spend.</p>
              </div>
            </div>
          </div>
          <div class="step-one fadeInRight animated wow" data-wow-duration="2s" data-wow-delay="1.0s">
            <div class="step-icon">
              <img src="theme/images/earn.png" />
            </div>
            <div class="step-text">
              <div class="step-head">
                <h5>earn profit</h5>
              </div>
              <div class="step-textt">
                <p>After complete, the deposit period your profit will be credited to your account. </p>
              </div>
            </div>
          </div>
          <!-- <center><img src="theme/images/i.png" width=auto height=auto></center> -->
        </div>
      </div>
    </div>
  </div>
  <section>
    <div class="container">
      <div class="row">
        <div class="about-head">
          <h4>Our Services</h4>
        </div>
        <div class="card-deck mb-3">

          <div class="card" style="width: 18rem;">
            <img class="card-img-top" width="18rem" height="150px" src="theme/images/forex.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Forex Trading</h5>
              <p class="card-text">Forex is a portmanteau of foreign currency and exchange...</p>

              <a href="forex" class="btn btn-primary">Read More</a>
            </div>
          </div>


          <div class="card" style="width: 18rem;">
            <img class="card-img-top" width="18rem" height="150px" src="theme/images/estate.jpeg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Real Estate</h5>
              <p class="card-text">Real estate investment involves the purchase, ownership, management...</p>

              <a href="estate" class="btn btn-primary">Read More</a>
            </div>
          </div>

          <div class="card" style="width: 18rem;">
            <img class="card-img-top" width="18rem" height="150px" src="theme/images/crypto.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Cryptocurrency</h5>
              <p class="card-text">Ominecoin Limited now offers all traders the opportunity to trade a wide...
              </p>

              <a href="crypto" class="btn btn-primary">Read More</a>
            </div>
          </div>

          <div class="card" style="width: 18rem;">
            <img class="card-img-top" width="18rem" height="150px" src="theme/images/gold.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Trading Gold</h5>
              <p class="card-text">Gold is commonly seen as a great store of wealth, this precious metal is also...</p>

              <a href="gold" class="btn btn-primary">Read More</a>
            </div>
          </div>


        </div>
        <div class="card-deck">

          <div class="card" style="width: 18rem;">
            <img class="card-img-top" width="18rem" height="150px" src="theme/images/oilgas.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Oil And Gas</h5>
              <p class="card-text">Surprising as it might be, anyone can invest in the oil market to make a profit...</p>

              <a href="oilgas" class="btn btn-primary">Read More</a>
            </div>
          </div>


          <div class="card" style="width: 18rem;">
            <img class="card-img-top" width="18rem" height="150px" src="theme/images/stocks.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"> Stock & Share</h5>
              <p class="card-text">A stock or share (also known as a company's "equity") is a financial instrument that...</p>

              <a href="stockshare" class="btn btn-primary">Read More</a>
            </div>
          </div>

          <div class="card" style="width: 18rem;">
            <img class="card-img-top" width="18rem" height="150px" src="theme/images/retire.jpeg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"> Retirement Planning</h5>
              <p class="card-text">Saving for retirement can be a daunting task, but with a sound strategy, it’s well...</p>

              <a href="retirement" class="btn btn-primary">Read More</a>
            </div>
          </div>




        </div>
      </div>
    </div>
  </section>

  <div class="depositContainer">
    <div class="depositInner">
      <div class="depositLeft fadeInLeft wow">
        <h3>Last Deposits <img src="styles/assets/styles/images/ctn-ic5.png"></h3>
        <div class="ctn-diposit-part1">
          <table>
            <tbody>

              <?php $classObj->latest_deposits(); ?>

            </tbody>
          </table>
        </div>
      </div>
      <div class="depositRight fadeInRight wow">
        <h3>Last withdrawals <img src="styles/assets/styles/images/ctn-ic6.png"></h3>
        <div class="ctn-diposit-part1">
          <table>
            <tbody>
              <?php $classObj->latest_withdrawals(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div id="main-refer">
    <div id="sub-refer">
      <div class="refer-icon">
        <img src="theme/images/referral.png" />
      </div>
      <div class="refer-text">
        <div class="refer-tittle">
          <p>Referral Commission</p>
        </div>
        <div class="refer-amount">
          <p>5% - 10%</p>
        </div>
        <div class="three-level">
          <p>4 Level <span>Referrals Commission Since
              partners are investors who are intere
              sted in the stability of their assets.</span></p>
        </div>
      </div>
      <div class="fborder">
      </div>
      <!-- <div class="news">
      </div> -->
      <div class="fborder">
      </div>
      <div class="service-footer">
        <div class="fo-contacts">
          <div class="news-head">
            <p>Our Services</p>
          </div>
          <div class="add-location">
            <ul style="list-style-type:disc;">
              <li><a href="forex">Forex Trading </a></li>
              <li><a href="estate">Real Estate</a></li>
              <li><a href="crypto">Cryptocurrency</a></li>
              <li><a href="gold">Gold Trading</a></li>
            </ul>
          </div>


        </div>
        <div class="fborder">
        </div>
        <div class="fborder">
        </div>
        <div class="fo-contacts">
          <div class="news-head">
            <p>Corporate Address</p>
          </div>
          <div class="add-location">
            <p><i class="fa fa-map-marker" aria-hidden="true"></i>381, Midsummer, Boulevard, Milton Keynes,Acron House Mk9 3HP, United Kingdom</p>
          </div>
          <div class="add-location">
            <p><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:info@ominecoinltd.com">info@ominecoinltd.com</a></p>
          </div>

        </div>
      </div>
    </div>
  </div>
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
  <?php require_once __DIR__ . '/incs/footer-index.php'; ?>
  <script>
    $(document).ready(function() {
      $('#invest_amount').keyup(function() {

        var inv_amount = $('#invest_amount').val();
        inv_amount = parseInt(inv_amount);
        var percent = '';
        var min_amount = '';
        var max_amount = '';
        $("#4select option:selected").each(function() {
          var pname = $(this).val();
          pname = pname.split(",");
          var plan_name = pname[0];
          min_amount = parseInt(pname[1]);
          max_amount = parseInt(pname[2]);
          percent = parseInt(pname[3]);

        });
        var profit = (percent / 100) * inv_amount;
        var t_profit = inv_amount + profit;
        // alert(t_profit);
        if (inv_amount < min_amount) {
          $('#profit_amount').html('you have to use at least $' + min_amount + ' for the plan');
        } else if (inv_amount > max_amount) {
          $('#profit_amount').html('you have exceeded $' + max_amount + '. which is d maximum amount');
        } else {
          $('#profit_amount').html(t_profit);
        }




      });
    });
  </script>
</body>

</html>
<?php ob_end_flush(); ?>