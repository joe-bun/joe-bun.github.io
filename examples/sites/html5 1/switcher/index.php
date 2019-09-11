<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <?php

        function UserAgent() {
            $a = $_SERVER['HTTP_USER_AGENT'];
            echo $a;
        }
        ?>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container">
            <header class="wrapper clearfix">
                <h1 class="title">Lab 1: Mobile/Desktop Switcher</h1>
                <!--<nav>
                    <ul>
                        <li><a href="#">nav ul li a</a></li>
                        <li><a href="#">nav ul li a</a></li>
                        <li><a href="#">nav ul li a</a></li>
                    </ul>
                </nav> -->
            </header>
        </div>

        <div class="main-container">
            <div class="main wrapper clearfix">

                <article>
                    <header>
                        <h1>Lab 1: Mobile/Desktop Switcher</h1>
                        <p>This website is in <span id="Device"></span> mode. Use your mobile phones "Request Desktop" feature to switch this site to a mobile version.</p>
                    </header>
                    <section>                
                        <p><span>User Agent:</span> <div id="UserAgent"><?php UserAgent(); ?></div></p>
                    </section>
                    <section>
                        <div id="Viewport"><span>Viewport:</span> 
                            <?php
                            include("php/mdetect.php");

                            $uagent_obj = new uagent_info();
                            if ($uagent_obj->DetectMobileLong() == $uagent_obj->true) {
                                $array = get_meta_tags("index.php");
                                echo "'< meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" >'";
                            } else {
                                echo "'< ! -- No Viewport Tag Included -- > '";
                            }
                            ?>
                        </div>
                    </section>
                    <section>
                        <div id="DeviceServerSide"><span>Type of Device Detected (server side):</span> 
                            <?php
                            if ($uagent_obj->DetectMobileLong() == $uagent_obj->true) {
                                echo "Mobile";
                            } else {
                                echo "Desktop";
                            }
                            ?>
                        </div>
                    </section>
                    <section>
                        <span>Type of Device Detected (client side):</span><div id="DeviceClientSide"></div>
                    </section>
                </article>

                <aside>
                    <h3>Viewport dimensions:</h3>
                    <table>
                        <tr><td></td><th>Width</th><th>Height</th></tr>
                        <tr><th>Page</th><td id="WidthPage"></td><td id="HeightPage"></td></tr>
                        <tr><th>Screen</th><td id="WidthScreen"></td><td id="HeightScreen"></td></tr>
                        <tr><th>ViewPort</th><td id="WidthViewPort"></td><td id="HeightViewPort"></td></tr>
                    </table>
                </aside>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer class="wrapper">
                <h3>Comp10133 - Viewport Switcher</h3>
            </footer>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>');</script>
        <script src="js/detectmobilebrowser.js"></script>
        <script src="js/main.js"></script>


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function (b, o, i, l, e, r) {
                b.GoogleAnalyticsObject = l;
                b[l] || (b[l] =
                        function () {
                            (b[l].q = b[l].q || []).push(arguments)
                        });
                b[l].l = +new Date;
                e = o.createElement(i);
                r = o.getElementsByTagName(i)[0];
                e.src = '//www.google-analytics.com/analytics.js';
                r.parentNode.insertBefore(e, r)
            }(window, document, 'script', 'ga'));
            ga('create', 'UA-XXXXX-X', 'auto');
            ga('send', 'pageview');
        </script>
    </body>
</html>
