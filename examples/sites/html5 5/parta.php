<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Jobanpreet Singh Aulakh, 000381413</title>
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
        <div class="container h1">Student Registry</div><br>
        <div class="container">
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="name" class="col-xs-4 control-label">Student Name: </label>
                    <div class="col-xs-5">
                        <input type="text" class="form-control" name="name" id="name" placeholder="" required>
                    </div>
                    <div id="nameInfo" class="col-xs-3"></div><br><br>

                    <label for="id" class="col-xs-4 control-label">Student ID: </label>
                    <div class="col-xs-5">
                        <input type="text" class="form-control" name="id" id="id" placeholder="" required>
                    </div>
                    <div id="idInfo" class="col-xs-3"></div><br><br>

                    <label for="program" class="col-xs-4 control-label">Program: </label>
                    <div class="col-xs-5">
                        <input type="text" class="form-control" name="program" id="program" placeholder="" required>
                    </div>
                    <div id="programInfo" class="col-xs-3"></div><br><br>

                    <div class="col-xs-offset-4 col-xs-8">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div> 
            </form> 
        </div> 
        <div class="container">
            <table class="table table-bordered ">
                <tr><th class="col-xs-4">Student Name</th><th class="col-xs-4">Student ID</th><th class="col-xs-4">Program</th></tr>
            </table>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>');</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script>
            $("#name,#id,#program").keyup(function ()
            {
                $.post(
                        "parta.phps",
                        {name: $("#name").val(), id: $("#id").val(), program: $("#program").val()},
                        function (data)
                        {
                            JsObject = eval(data);
                            if (JsObject.name === "error")
                            {
                                $("#nameInfo").html("Student name cannot contain digits.").removeClass().addClass("text-danger");
                            } else if (JsObject.name === "warning")
                            {
                                $("#nameInfo").html("Student name may be fictitious.").removeClass().addClass("text-warning");
                            } else if (JsObject.name === "valid")
                            {
                                $("#nameInfo").html("").attr("role", "alert").removeClass().addClass("text-success");
                            }

                            if (JsObject.id === "error")
                            {
                                $("#idInfo").html("Student ID must only contain digits.").removeClass().addClass("text-danger");
                            } else if (JsObject.id === "warning")
                            {
                                $("#idInfo").html("Student ID is suspicious.").removeClass().addClass("text-warning");
                            } else if (JsObject.id === "valid")
                            {
                                $("#idInfo").html("").attr("role", "alert").removeClass().addClass("text-success");
                            }

                            if (JsObject.program === "error")
                            {
                                $("#programInfo").html("Program does not exist.").removeClass().addClass("text-danger");
                            } else if (JsObject.program === "warning")
                            {
                                $("#programInfo").html("Program may be fictitious.").removeClass().addClass("text-warning");
                            } else if (JsObject.program === "valid")
                            {
                                $("#programInfo").html("").attr("role", "alert").addClass("text-success");
                            }

                        }
                );
            });


            $(".form-horizontal").submit(function (event) {
                if ((JsObject.name === "error" || JsObject.id === "error" || JsObject.program === "error" || JsObject.name === JsObject.id === JsObject.program === "")) {
                    event.preventDefault();
                } else {

                    var tr = document.createElement("tr");

                    var td = document.createElement("td");
                    tr.appendChild(td);
                    td.innerText = $("#name").val();

                    var td = document.createElement("td");
                    tr.appendChild(td);
                    td.innerText = $("#id").val();

                    var td = document.createElement("td");
                    tr.appendChild(td);
                    td.innerText = $("#program").val();

                    if (JsObject.name === "warning" || JsObject.id === "error" || JsObject.program === "error") {
                        tr.addclass("bg-warning");
                    }

                    $(".table").appendChild(tr);
                    $(".form-horizontal").trigger("reset");
                }
            });
        </script>

    </body>
</html>
