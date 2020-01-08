<?php
if (!defined('INITIALIZED'))
    exit;
?>

    <!doctype html>
    <html lang="pl">

    <head>
        <meta charset="utf-8" />
        <title>
            <?php echo $title?>
        </title>
        <meta name="description" content="The true oldschool gameplay." />
        <meta name="keywords" content="ArkSoft" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <link rel="icon" href="<?php echo $layout_name; ?>/assets/img/ArkSoft-icon.png">

        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo $layout_name; ?>/assets/css/main.css<?php echo $css_version; ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo $layout_name; ?>/assets/css/iziModal.css<?php echo $css_version; ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo $layout_name; ?>/assets/css/fontello.css<?php echo $css_version; ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo $layout_name; ?>/assets/fonts/cambria.ttf" type="text/css" />
        <link rel="stylesheet" href="<?php echo $layout_name; ?>/assets/css/lightbox.min.css<?php echo $css_version; ?>" type="text/css" />

        <!-- JS -->
        <!-- Remember to include jQuery :) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

        <!-- jQuery Modal -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>   
        <script src="<?php echo $layout_name; ?>/assets/js/ajaxcip.js<?php echo $css_version; ?>"></script>
        <script src="<?php echo $layout_name; ?>/assets/js/generic.js<?php echo $css_version;?>"></script>
        <script src="<?php echo $layout_name; ?>/assets/js/initialize.js<?php echo $css_version;?>"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="https://kit.fontawesome.com/38f230bee4.js"></script>
        
        <?php if ($subtopic == 'adminpanel') { ?>
            <script src="<?php echo $layout_name; ?>/assets/js/ajaxmonteiro.js<?php echo $css_version; ?>"></script>
        <?php } ?>
        <!--Tiny Editor 
        <script type="text/javascript" src="./vendor/tinymce/tinymce/tinymce.min.js"></script>-->
        <script src="<?php echo $layout_name; ?>/assets/js/iziToast.min.js<?php echo $css_version; ?>"></script>
        <script async src="<?php echo $layout_name; ?>/assets/js/iziModal.js<?php echo $css_version; ?>"></script>



        <?php
           if ($_REQUEST['subtopic'] == "createaccount") echo '<script src="' . $layout_name . '/assets/js/create_character.js' . $css_version . '"></script>';
        ?>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="/">
    </head>

    <body class='page_index'>
        <main class="preload">
            <div id="topbar">
                <div class="middle-topbar">
                    <div class="social-topbar">
                        <a href="#" target="_blank">
                        <img src="<?php echo $layout_name; ?>/assets/img/icons/discord-icon.png" style="height: 25px; width:25px;">
                    </a>
                    </div>
                    <div class="social-topbar">
                        <a href="#" target="_blank">
                        <img src="<?php echo $layout_name; ?>/assets/img/youtube.png" style="height: 25px; width:25px;">
                    </a>
                    </div>
                    <div class="social-topbar">
                        <a href="https://www.facebook.com/ArkSoft.online/" target="_blank">
                        <img src="<?php echo $layout_name; ?>/assets/img/facebook.png" style="height: 25px; width:25px;">
                    </a>
                    </div>
                </div>
                <div class="right-topbar">
                    <div style="float:right;font-family: cambria;margin-top:16px;margin-left:10px;margin-right:15px;">support@arksoft.site</div>
                    <div style="float:right;margin-top:18px;">CONTACT US:</div>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div id="wrapper">
                <div id="logo">
                    <a href="/">
				<img src="<?php echo $layout_name; ?>/assets/img/logo.png">
				</a>
                    <!-- temporary countdown  -->
                    <div id="tkn-countdown" style="text-align:center;font-family:assassin;font-size:30px;color:#d8b46c;
text-shadow: 0 0 10px #FFFFFF;"></div>
                    <script>
                        var countDownDate = new Date("Jan 31, 2020 15:37:25").getTime();

                        var x = setInterval(function() {
                            var now = new Date().getTime();
                            var distance = countDownDate - now;

                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            document.getElementById("tkn-countdown").innerHTML = days + " day " + hours + " hours " + minutes + " minutes " + seconds + " seconds ";

                            if (distance < 0) {
                                clearInterval(x);
                                document.getElementById("tkn-countdown").innerHTML = "Server Started!";
                            }
                        }, 1000);
                    </script>
                    <!-- end of temporary countdown -->
                </div>
                <!-- mav -->
                <nav>
                    <div id="nav">
                        <ul class="menu-list">
                            <li class="menu-element">
                                <a href="/" class="menu-msg">HOME</a>
                            </li>
                            <li class="menu-separator">
                                <img src="<?php echo $layout_name; ?>/assets/img/header-menu-spacer.png" />
                            </li>
                            <li class="menu-element">
                                <a href="/sub.php?page=community" class="menu-msg">COMMUNITY</a>
                            </li>
                            <li class="menu-separator">
                                <img src="<?php echo $layout_name; ?>/assets/img/header-menu-spacer.png" />
                            </li>
                            <li class="menu-element">
                                <a href="/highscores" class="menu-msg">HIGHSCORES</a>
                            </li>
                            <li class="menu-separator">
                                <img src="<?php echo $layout_name; ?>/assets/img/header-menu-spacer.png" />
                            </li>
                            <li class="menu-element">
                                <a href="sub.php?page=library" class="menu-msg">LIBRARY</a>
                            </li>
                            <li class="menu-separator">
                                <img src="<?php echo $layout_name; ?>/assets/img/header-menu-spacer.png" />
                            </li>
                            <li class="menu-element">
                                <a href="/shop" class="menu-msg">PREMIUM</a>
                            </li>
                            <li class="menu-separator">
                                <img src="<?php echo $layout_name; ?>/assets/img/header-menu-spacer.png" />
                            </li>
                            <li class="menu-element">
                                <a href="#" target="_BLANK" class="menu-msg">DISCORD</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <content>
                    <div id="container">
                        <div class="left-container">
                        <div class="frame-box">
                          <div class="frame-box-inner frame-box-inner--light">

                                <!-- News -->

                                   <?php echo $main_content;?>

                    
                                <!-- End of news -->
                                <!-- Slider -->
                                <script>
                                    var slideIndex = 0;
                                    showSlides();

                                    function showSlides() {
                                        var i;
                                        var slides = document.getElementsByClassName("slider");
                                        for (i = 0; i < slides.length; i++) {
                                            slides[i].style.display = "none";
                                        }
                                        slideIndex++;
                                        if (slideIndex > slides.length) {
                                            slideIndex = 1
                                        }
                                        slides[slideIndex - 1].style.display = "block";
                                        setTimeout(showSlides, 4000); // Change image every 5 seconds
                                    }
                                </script>
                                <!-- end of Slider -->
                        </div>
                 </div>
          </div>

                        <div class="right-container">
                            <div class="widget login">

                            <?php
                              if($logged) {
                           ?>

                                <div class="widget game">
                                    <div class="game-up-section" style="margin-top:1px;">
                                        <div class="game-up-image">
                                            <img src="<?php echo $layout_name; ?>/assets/img/account.png">
                                        </div>
                                        <div class="game-up-text">
                                            Account
                                        </div>
                                    </div>

                                    <a href="?subtopic=accountmanagement">
                                    <div class="game-register">
                                        <div class="game-register-image">
                                            <img src="<?php echo $layout_name; ?>/assets/img/icons/myaccount.png">
                                        </div>
                                        <div class="game-register-text">
                                            My Account
                                        </div>
                                    </div>
                                    </a>

                                    <a href="?subtopic=accountmanagement&action=createcharacter">
                                    <div class="game-register">
                                        <div class="game-register-image">
                                            <img src="<?php echo $layout_name; ?>/assets/img/icons/create.png">
                                        </div>
                                        <div class="game-register-text">
                                            Create Character
                                        </div>
                                    </div>
                                    </a>

                                    <a href="?subtopic=accountmanagement&action=changepassword">
                                    <div class="game-register">
                                        <div class="game-register-image">
                                            <img src="<?php echo $layout_name; ?>/assets/img/icons/changepassword.png">
                                        </div>
                                        <div class="game-register-text">
                                            Change Password
                                        </div>
                                    </div>
                                    </a>

                                    <!--<a href="#">
                                    <div class="game-register">
                                        <div class="game-register-image">
                                            <img src="<?php echo $layout_name; ?>/assets/img/icons/settings.png">
                                        </div>
                                        <div class="game-register-text">
                                            Settings
                                        </div>
                                    </div>
                                    </a> -->

                                    <a href="?subtopic=accountmanagement&action=logout">
                                    <div class="game-register" style="margin-bottom:12px;">
                                        <div class="game-register-image">
                                            <img src="<?php echo $layout_name; ?>/assets/img/icons/exit.png">
                                        </div>
                                        <div class="game-register-text">
                                            Logout
                                        </div>
                                    </div>
                                    </a>
                                </div>

                                <?php
                                     }
                                 else
                                     {
                                ?>


                                <div class="login-up-section">
                                    <img src="<?php echo $layout_name; ?>/assets/img/icons/account-icon.png">
                                    <p class="login-up-text">Login</p>
                                </div>
                                <script>
                                function onSubmit(token) {
                                    document.getElementById("loginform").submit();
                                 }
                                </script>
                                <form action="?subtopic=accountmanagement" id="loginform" method="post">

                                  <input type="hidden" name="login" value="ok">
                                    <label for="username">Account:</label>
                                    <input type="password" name="account_login" value="<?=$_POST["account_login"];?>" size="20" maxlength="30" >

                                    <label for="password">Password:</label>
                                    <input type="password" name="password_login" value="<?=$_POST["password_login"];?>" size="20" maxlength="29" >

                                    <button class="g-recaptcha" data-sitekey="<?=Website::getWebsiteConfig()->getValue('gRecaptchaSiteKey');?>" data-callback='onSubmit'>Submit</button>
                            </div>

                            <?php
                                }
                            ?>
                            <div class="widget game" style="margin-top:2px;">
                                <div class="game-up-section">
                                    <div class="game-up-image">
                                        <img src="<?php echo $layout_name; ?>/assets/img/account.png">
                                    </div>
                                    <div class="game-up-text">
                                        Game
                                    </div>
                                </div>
                                <a href="register">
                                    <div class="game-register">
                                        <div class="game-register-image">
                                            <img src="<?php echo $layout_name; ?>/assets/img/icons/register-icon.png">
                                        </div>
                                        <div class="game-register-text">
                                            Register Account
                                        </div>
                                    </div>
                                </a>
                                <a href="recovery">
                                    <div class="game-download">
                                        <div class="game-download-image">
                                            <img src="<?php echo $layout_name; ?>/assets/img/icons/lostaccount-icon.png">
                                        </div>
                                        <div class="game-download-text">
                                            Lost Account?
                                        </div>
                                    </div>
                                </a>
                                <a href="downloads">
                                    <div class="game-download">
                                        <div class="game-download-image">
                                            <img src="<?php echo $layout_name; ?>/assets/img/icons/download-icon.png">
                                        </div>
                                        <div class="game-download-text">
                                            Download Client
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="widget server-status">
                                <div class="server-status-up-section">
                                    <div class="server-status-up-image">
                                        <img src="<?php echo $layout_name; ?>/assets/img/server-status.png">
                                    </div>
                                    <div class="server-status-up-text">
                                        Server Status
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                                <a href="onlinelist">
                                    <div class="server-status-online">
                                        <div class="server-status-online-icon">
                                            <img src="<?php echo $layout_name; ?>/assets/img/status-on.png">
                                        </div>
                                        <div class="server-status-online-text">
                                            <span class="server-status-online-number">0</span> Players Online
                                        </div>
                                    </div>
                                </a>
                                <div class="server-status-online">
                                    <div class="server-status-save-icon">
                                        <img src="<?php echo $layout_name; ?>/assets/img/star.png">
                                    </div>
                                    <div class="server-status-save-text">
                                        Registered Accounts:
                                    </div>
                                    <span class="server-status-save-time">0</span>
                                    <div style="clear: both;"></div>
                                </div>

                            </div>
                            <div class="widget topics" style="border-bottom: 1px solid #5a4b49;margin-top:-2px;box-shadow: 0px 0px 26px 6px rgba(0,0,0,0.75);">
                                <div class="topics-up-section">
                                    <div class="topics-up-image">
                                        <img src="<?php echo $layout_name; ?>/assets/img/icons/topics-icon.png">
                                    </div>
                                    <div class="topics-up-text">
                                        Changelog
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                                <a href="changelog">
                                    <div class="new-topic">
                                        <div class="topic-title">
                                        ArkSoft ArkSoft to ArkSoft. </div>
                                        <div class="topic-info">
                                            <time>22 December 2019 (10:30)</time>
                                            <span>ArkSoft</span>
                                        </div>
                                    </div>
                                </a>
                                <a href="changelog">
                                    <div class="new-topic">
                                        <div class="topic-title">
                                            Special ArkSoft ArkSoft ArkSoft</div>
                                        <div class="topic-info">
                                            <time>20 December 2019 (10:28)</time>
                                            <span>ArkSoft</span>
                                        </div>
                                    </div>
                                </a>
            
                 
        
                            </div>
                        </div>
                    </div>
                </content>
            </div>
            </div>
            </div>
            <footer>
                <div id="footer">
                    <div class="footer-text">
                        Arksoft Company 2019 &copy; All rights reserved.
                        <br />
                        <br /> Design by <a href="/characterprofile.php?name=tkn">TKN</a>. Engine: <a href="#" target="_blank">Gesior</a>.
                    </div>
                </div>
            </footer>
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script><script src="<?php echo $layout_name; ?>/assets/js/lightbox-plus-jquery.min.js"></script>
    
    </body>

    </html>