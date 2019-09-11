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

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Comp10043: Lab4: Forms and Local Storage</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">

                </div><!--/.navbar-collapse -->
            </div>
        </nav>
        <div class="container ">
            <span id="JS" class="label label-danger">Please turn on JavaScript</span>
        </div>
        <div class="container" id="info"></div>
        <br>
        <div class="container ">
            Network Status: <span id="NetworkStatus"></span> Local Storage: <span id="LocalStorage"></span>
        </div>
        <br>
        <div class="container-fluid" id="btns">
            <button type="button" onclick="SaveToLocalStorage()" class="btn btn-primary col-xs-4">Save Form Values to Local Storage</button>
            <button type="button" onclick="ClearLocalStorage()" class="btn btn-info col-xs-4">Clear Local Storage and Form</button>
            <button type="button" onclick="LoadFromLocalStorage()" class="btn btn-primary col-xs-4">Load Form Values from Local Storage</button>
        </div>
        <div class="jumbotron">
            <div class="container-fluid">
                <h2>Personal Interest Form</h2>
                <form class="form-horizontal" action="https://csunix.mohawkcollege.ca/tooltime/echo.php" method="post">
                    <div class="form-group">
                        <label for="name" class="col-xs-4 control-label">Name: </label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" name="name" id="name" placeholder="First and Last Name" required>
                        </div>
                        <div id="name-Support" class="col-xs-3"></div><br>

                        <label for="date" class="col-xs-4 control-label">Date of birth: </label>
                        <div class="col-xs-5">
                            <input type="date" class="form-control" name="date" id="date" placeholder="Date of Birth (mm/dd/yyyy)" required>
                        </div>
                        <div id="date-Support" class="col-xs-3"></div><br>

                        <label for="email" class="col-xs-4 control-label">Email: </label>
                        <div class="col-xs-5">
                            <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required>
                        </div>
                        <div id="email-Support" class="col-xs-3"></div><br>

                        <label for="age" class="col-xs-4 control-label">Age: </label>
                        <div class="col-xs-5">
                            <input type="number" class="form-control" name="age" id="age" min="18" max="90" placeholder="Your age (18-90)" required>
                        </div>
                        <div id="age-Support" class="col-xs-3"></div><br>

                        <label for="code" class="col-xs-4 control-label">Cdn Postal Code: </label>
                        <div class="col-xs-5">
                            <input type="text" pattern="[A-Za-z][0-9][A-Za-z] ?[0-9][A-Za-z][0-9]" class="form-control" name="code" id="code" placeholder="Cdn Postal Code" required>
                        </div>
                        <div id="code-Support" class="col-xs-3"></div><br>

                        <label for="interests" class="col-xs-4 control-label">Interests: </label>
                        <div class="col-xs-8">
                            <div class="checkbox">
                                <label>
                                    <input name="interests" type="checkbox" value="music" id="music"> Music
                                </label>

                                <label>
                                    <input name="interests" type="checkbox" value="software" id="software"> Software
                                </label>

                                <label>
                                    <input name="interests" type="checkbox" value="hardware" id="hardware"> Hardware
                                </label>
                            </div>
                        </div><br>

                        <label for="gender" class="col-xs-4 control-label">Gender: </label>
                        <div class="col-xs-8">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" value="male" id="male" required> Male
                                </label>

                                <label>
                                    <input type="radio" name="gender" value="female" id="female" required> Female
                                </label>
                            </div>
                        </div><br>
                        <?php
                        $PROVINCES = array("--" => "---Select a Province---",
                            "ab" => "Alberta",
                            "bc" => "British Columbia",
                            "mb" => "Manitoba",
                            "nb" => "New Brunswick",
                            "nf" => "Newfoundland",
                            "nt" => "Northwest Territories",
                            "ns" => "Nova Scotia",
                            "on" => "Ontario",
                            "pe" => "PrinceEdwardIsland",
                            "qc" => "Quebec",
                            "sk" => "Saskatchewan");
                        ?>
                        <label for="province" class="col-xs-4 control-label" > Province: </label>
                        <div class="col-xs-8">
                            <select name="province" id="province"  required multiple>
                                <?php
                                foreach ($PROVINCES as $KEY => $VAL) {
                                    echo "<option value='$VAL' id='$VAL'";
                                    echo ">$VAL</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-offset-4 col-xs-8">
                        <button type="submit" class="btn btn-default">Submit To Server</button>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-default">Reload Page</a>
                        <a href="#"> <span class="glyphicon glyphicon-check" title="Populate Form with valid test Values" onclick="PopulateForm()"></span></a>
                    </div>

                </form>
            </div>
        </div>
        <div class="container">

            <hr>
            <footer>
                <p>Comp10043: Lab4: Forms and Local Storage</p>
            </footer>
        </div> <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>');</script>
        <script src="js/plugins.js"></script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
                            (function (b, o, i, l, e, r) {
                                b.GoogleAnalyticsObject = l;
                                b[l] || (b[l] =
                                        function () {
                                            (b[l].q = b[l].q || []).push(arguments);
                                        });
                                b[l].l = +new Date;
                                e = o.createElement(i);
                                r = o.getElementsByTagName(i)[0];
                                e.src = '//www.google-analytics.com/analytics.js';
                                r.parentNode.insertBefore(e, r);
                            }(window, document, 'script', 'ga'));
                            ga('create', 'UA-XXXXX-X', 'auto');
                            ga('send', 'pageview');
        </script>
    </body>
</html>
