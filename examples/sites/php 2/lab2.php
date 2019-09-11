<!DOCTYPE html>
<!--
StAuth10065: I Jobanpreet Singh Aulakh, 000381413 certify that this material is my original work. No other person's work has been used without due acknowledgement. I have not made my work available to anyone else.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            body{
                text-align: center;
                width: 35%;
            }
            h1{
                color: lightgrey;
            }
            form{
                background-color: lightgrey;               
                width:85%;
                margin-left: 7%;
            }
            #dark{
                background-color: orange;
            }
            #light{
                background-color: yellow;
            }
            #highlight{
                background-color: orangered;
            }
            table{
                border: 1px solid black;
                width: 80%;
                padding:1%;
            }
            td{
                padding:1.8%;
                border: 1px solid white;
            }
            input[type=text]{
                width: 10%;
            }
        </style>
    </head>
    <body>
        <?php

        function generate_table($rows = 10, $cols = 10, $highlight = 5) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                if (is_numeric($rows)) {
                    if
                    ($rows > 15) {
                        $rows = 15;
                    }
                } else {
                    $rows = 10;
                }
                if (is_numeric($cols)) {
                    if
                    ($cols > 15) {
                        $cols = 15;
                    }
                } else {
                    $cols = 10;
                }
                if (is_numeric($highlight)) {
                    if
                    ($highlight > 15) {
                        $highlight = 15;
                    }
                } else {
                    $highlight = 5;
                }
            }
            $current = Rand(0, 100);
            echo "<p>First value is an ";
            if ($current % 2 === 0) {
                $id = "light";
                echo "<span id='$id'>even</span> ";
            } else {
                $id = "dark";
                echo "<span id='$id'>odd</span> ";
            }
            echo "number</p>";
            echo "\n        <table align='center'>";
            for ($j = 0; $j < $rows; $j++) {
                echo "\n              <tr>\n";
                for ($i = 0; $i < $cols; $i++) {
                    if ($current != 0 && $highlight != 0 && $current % $highlight === 0) {
                        $tempId = $id;
                        $id = "highlight";
                    }
                    echo "                  <td id='$id' >$current</td>\n";
                    $current++;
                    if ($id === "highlight") {
                        $id = $tempId;
                    }
                }
                if ($id === "dark") {
                    $id = "light";
                } else if ($id === "light") {
                    $id = "dark";
                }
                echo "              </tr>\n";
            }
            echo "          </table>\n";
        }
        ?>
        <h1>Table Generator</h1>
        <p><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Refresh</a></p>
        <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label>Rows: </label>
            <input name="Rows" type="text" value="<?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (is_numeric($_POST['Rows'])) {
                    if ($_POST['Rows'] <= 15) {
                        echo $_POST['Rows'];
                    } else {
                        echo 15;
                    }
                } else {
                    echo 10;
                }
            } else {
                echo 10;
            }
            ?>">

            <label>Cols: </label>
            <input name="Cols" type="text" value="<?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (is_numeric($_POST['Cols'])) {
                    if ($_POST['Cols'] <= 15) {
                        echo $_POST['Cols'];
                    } else {
                        echo 15;
                    }
                } else {
                    echo 10;
                }
            } else {
                echo 10;
            }
            ?>">
            <label>Highlight: </label><input name="Highlight" type="text" value="<?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (is_numeric($_POST['Highlight'])) {
                    if ($_POST['Highlight'] <= 15) {
                        echo $_POST['Highlight'];
                    } else {
                        echo 15;
                    }
                } else {
                    echo 5;
                }
            } else {
                echo 5;
            }
            ?>"><br>
            <input type="submit" value="Generate Table with Form Value" >            
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            generate_table($_POST['Rows'], $_POST['Cols'], $_POST['Highlight']);
            echo "          <p>\n";

            print_r($_POST);
            echo "          </p>\n";
        } else {
            generate_table();
        }
        ?>
    </body>
</html>