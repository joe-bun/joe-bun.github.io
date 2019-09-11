<!DOCTYPE html>
<!--
 StAuth10065: I Jobanpreet Singh Aulakh, 000381413 certify that this material is my original work. No other person's work has been used without due acknowledgement. I have not made my work available to anyone else.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            Jobanpreet Singh Aulakh, 000381413
        </title>
        <style>
            h1{
                color: green;
            }
            nav ul {

                list-style-type: none;
                margin-top: 1em;
                margin-bottom: 1em;
                margin-left: 0;
                padding-left: 0;
            }
            nav ul li{
                display: inline-block;

                margin-right: 10px;
                padding: 2px;
                background-color: green;

            }
            nav ul li a{
                text-decoration: none;
                color: white;
            }
            form table{
                border: 1px solid white;
                width: 54%;
                margin-left: 1%;
                margin-bottom: 1em;
            }
            form table tr{
                height: 4.5em;
            }
            form table td{
                background-color: lightgray;
            }

            form table td.col1{
                color: white;
                background-color: green;
                width:12%;
                text-align: center;

            }
            form table td.col2{
                vertical-align: top;
                width: 38%;
            }
            form table tr td input{
                margin-top: 0.4em;
                border: 5px solid white;
                background-color: whitesmoke;
                height: 3em;
                width:96%;

            }
            p.success{
                color: green;
                border: 1px solid green;
                padding-top: 2em;
                padding-bottom: 2em;
                padding-left: 1em;
                padding-right: 1em;
                width: 30%;
                margin-left: 1%;
            }
            div.fail{
                border: 1px solid gray;
                margin-left:1%;
                width: 20%;
            }
            #red, td.error{
                color:red;
            }
            table{
                border: 1px solid white;
                margin-left: 1%;
                margin-bottom: 1em;
                width: auto;
            }
            table td{
                background-color: lightgray;
                border: 1px solid lightgray;
                height: auto;
                padding: 0.1em;
            }
            table th{
                background-color: green;
                color: white;
                text-align: center;
                border: 1px solid lightgray;
                height: auto;
                width: auto;
            }

        </style>
    </head>
    <body>        
        <h1>Form Validation with Reg Expressions and CSV</h1>
        <nav>
            <ul>
                <li>
                    <a href="<?php
                    $refresh = explode('?', $_SERVER['PHP_SELF']);
                    echo $refresh[0];
                    ?>" >
                        Refresh This Page
                    </a>
                </li>
                <li>
                    <a href="logfile.txt" target="_blank">
                        Show Logfile.txt
                    </a>
                </li>
                <li>
                    <form hidden action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
                        <input type="hidden" name="formattedLogFile" value="true">
                        <input type="submit">
                    </form>
                    <a href="<?php $_SERVER['PHP_SELF'] ?>?formattedLogFile=true">
                        Show Logfile.txt Formatted
                    </a>
                </li>
                <li>
                    <form hidden action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
                        <input type="hidden" name="clear" value="true">
                        <input type="submit">
                    </form>
                    <a href="<?php $_SERVER['PHP_SELF'] ?>?clear=true">
                        Clear Logfile.txt
                    </a >
                    <?php
                    if (isset($_GET['clear'])) {
                        fopen("logfile.txt", "w");
                    }
                    ?>
                </li>
            </ul>
        </nav>
        <?php
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $error = array();
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            if (!preg_match("/^(Mr\.|Mrs\.) +[a-zA-Z]+ +[a-zA-Z]+/", $_POST['uname'])) {
                $error['uname'] = "Fullname not entered correctly.";
            }
            if (!preg_match("/^[0-9]{2,3} +[a-zA-Z]+ +(Road|Street)+/", $_POST['street'])) {
                $error['street'] = "Street address not entered correctly.";
            }
            if (!preg_match("/^[^abclxyzABCLXYZ0-9][^abclxyzABCLXYZ0-9][^0a-zA-Z][ -]?[^abclxyzABCLXYZ0-9][^0a-zA-Z][^0a-zA-Z]/i", $_POST['postalcode'])) {
                $error['postalcode'] = "Postal Code in wrong format!";
            }
            if (!preg_match("/^\(?\d{3}\)?[ ._]?\d{3}[ ._]?\d{4}/", $_POST['phone'])) {
                $error['phone'] = "Invalid Phone Number";
            }
            if (!preg_match("/^\w{4,10}\.\w{4,10}@mohawkcollege\.(com|ca|org)/", $_POST['email'])) {
                $error['email'] = "Email is in wrong format!";
            }
            if (count($error) !== 0) {
                echo "<div class='fail'><p id='red'>These are errors in the code:</p>";
                echo "<ul>";
                foreach ($error as $KEY => $VAL) {
                    if (!(empty($VAL))) {
                        echo "<li>$VAL</li>";
                    }
                }
                echo "</ul></div><br>";
            } else {
                echo "<p class='success'>Thank you " . $_POST['name'] . " for your submission. you submitted:<br>";
                foreach ($_POST as $KEY => $VAL) {

                    if ($KEY === 'email') {
                        echo "$VAL";
                    } else {
                        echo "$VAL, ";
                    }
                }
                echo " </p><br>";
                $file = fopen("logfile.txt", "a+");
                fputcsv($file, $_POST);
                fclose($file);
            }
        }
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="hidden" name="ip" value="<?php echo $_SERVER['SERVER_ADDR']; ?>">
            <input type="hidden" name="time" value="<?php echo date("Ymd H:i:s"); ?>">
            <table>
                <tr>
                    <td class="col1">
                        <Label>
                            Full Name:
                        </Label>                        
                    </td>
                    <td class="col2">
                        <Label>
                            <input name="uname" type="text" value="<?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                echo $_POST['uname'];
                            }
                            ?>">
                        </Label>                        
                    </td>
                    <td <?php echo (isset($error["uname"])) ? "class='error'" : ""; ?>>
                        <Label>
                            Salutation of Mr. or Mrs. followed by two text strings separated by any number of spaces.
                        </Label>                        
                    </td>
                </tr>
                <tr>
                    <td class="col1">
                        <Label>
                            Street:
                        </Label>                        
                    </td>
                    <td class="col2">
                        <Label>
                            <input name="street" type="text" value="<?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                echo $_POST['street'];
                            }
                            ?>">
                        </Label>                        
                    </td>
                    <td <?php echo (isset($error["street"])) ? "class='error'" : ""; ?>>
                        <Label>
                            2 or 3 digit number followed by a text string ending with Street or Road separated by any number of spaces.
                        </Label>                        
                    </td>
                </tr> 
                <tr>
                    <td class="col1">
                        <Label>
                            PostalCode:
                        </Label>                        
                    </td>
                    <td class="col2">
                        <Label>
                            <input name="postalcode" type="text" value="<?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                echo $_POST['postalcode'];
                            }
                            ?>">
                        </Label>                        
                    </td>
                    <td <?php echo (isset($error["postalcode"])) ? "class='error'" : ""; ?>>
                        <Label>
                            Char Char Digit optional Hyphen or space Char Digit Digit (abclxyz and number 0 not allowed. Case insensitive. )
                        </Label>                        
                    </td>
                </tr>
                <tr>
                    <td class="col1">
                        <Label>
                            Phone:
                        </Label>                        
                    </td>
                    <td class="col2">
                        <Label>
                            <input name="phone" type="text" value="<?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                echo $_POST['phone'];
                            }
                            ?>">
                        </Label>                        
                    </td>
                    <td <?php echo (isset($error["phone"])) ? "class='error'" : ""; ?>>
                        <Label>
                            10 digits, first 3 digits have optional parentheses, either side of digits 456 are optional space, dot or hyphen.
                        </Label>                        
                    </td>
                </tr>
                <tr>
                    <td class="col1">
                        <Label>
                            Email:
                        </Label>                        
                    </td>
                    <td class="col2">
                        <Label>
                            <input name="email" type="text" value="<?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                echo $_POST['email'];
                            }
                            ?>">
                        </Label>                        
                    </td>
                    <td <?php echo (isset($error["email"])) ? "class='error'" : ""; ?>>
                        <Label>
                            firstname.lastname@mohawkcollege.domain (firstname and lastname must be 4-10 characters in length, domain may be either .com, .ca or .org)
                        </Label>                        
                    </td>
                </tr>
            </table>
            <input type="submit" value="Submit me now!!!">
        </form>
        <?php
        if (isset($_GET['formattedLogFile'])) {
            echo "<table>";
            echo "<tr><th>IP Address</th><th>Time Stamp</th><th>Name</th><th>Street</th><th>Postal Code</th><th>Phone</th><th>Email</th></tr>";
            $file = fopen("logfile.txt", "r");
            while (!feof($file)) {
                echo "<tr>";
                $line = fgetcsv($file);
                foreach ($line as $KEY => $VALUE) {
                    echo "<td>$VALUE</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            fclose($file);
        }
        ?>
    </body>
</html>