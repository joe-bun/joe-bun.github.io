<!DOCTYPE html>
<!--
StAuth10065: I Jobanpreet Singh Aulakh, 000381413 certify that this material is my original work. No other person's work has been used without due acknowledgement. I have not made my work available to anyone else.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Jobanpreet Singh Aulakh, 000381413</title>
        <style>
            body{
                width:60%;
            }
            form{
                margin-left: 2%;
                border: 1px solid lightgray;
                border-collapse: collapse;
                border-bottom-color: black;
                padding: 4px;
            }
            fieldset{
                border: 1px solid lightgray;
            }
            td.col1{
                width: 190px;              
                text-align:right;
                vertical-align: top;
            }

            input.error,  table.error, tr.error, select.error, p.error{
                background: lightgoldenrodyellow;
            }
            table.error{
                width:100%;
            }

            p.green, h1, h3{
                color: green;
            }
            span{
                color: red;
            }
            td.colempty{
                width:69%;

            }
            table.success td{
                border: 1px solid gray;

            }
            table.success{
                border: 1px solid gray;
                border-collapse: collapse;
                background: lightgoldenrodyellow;

            }
            td.key{
                font-weight: bold;
                text-align: center;
                border: 1px solid gray;
                border-collapse: collapse;
            }
            td.head{
                border: 1px solid gray;
                border-collapse: collapse;

            }
            table.submit{
                margin-top: 10px;
                border: 1px solid gray;
                border-collapse: collapse;
                width: 100%;

            }


        </style>
    </head>
    <body>
        <?php
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $PROVINCES = array("--" => "---Please Select Provinces---",
            "nf" => "Newfoundland",
            "pe" => "PrinceEdwardIsland",
            "nb" => "New Brunswick",
            "ns" => "Nova Scotia",
            "qc" => "Quebec",
            "on" => "Ontario",
            "mb" => "Manitoba",
            "sk" => "Saskatchewan",
            "ab" => "Alberta",
            "bc" => "British Columbia",
            "nt" => "Northwest Territories");
        $Error = array();


        $name = $email = $year = $month = $province = $status = $location = "";

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {


            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $year = test_input($_POST["year"]);
            $month = test_input($_POST["month"]);
            foreach ($_POST["province"] as $KEY => $VAL) {
                $province = implode(", ", test_input("VAL"));
            }
            foreach ($_POST["status"] as $KEY => $VAL) {
                $status = implode(", ", test_input($VAL));
            }

            $location = test_input($_POST["location"]);


            if (empty($name)) {
                $Error['name'] = " Username cannot be empty.";
            } else if (strlen($name) < 5) {
                $Error['name'] = " Username must be greater than 5 characters.";
            }
            if (empty($year)) {
                $Error['year'] = "Year cannot be empty.";
            } else if (!is_numeric($year) || strlen($year) > 4 || strlen($year) < 4) {
                $Error['year'] = "Year must be a 4 digit number.";
            }
            if (!empty($month)) {
                if (is_numeric($month)) {
                    if ($month > 12 || $month < 1) {
                        $Error['month'] = "Month should be a number in range 1 -12.";
                    }
                } else {
                    $Error['month'] = "Month should be a number in range 1 -12.";
                }
            }
            if (!isset($_POST["province"])) {
                $Error['province'] = "Please select one or more provinces.";
            } else if (in_array("---Please Select Provinces---", $_POST["province"])) {
                $Error['province'] = "'---Please Select Provinces---' is not a valid province choice.";
            }
            if (!isset($_POST["status"])) {
                $Error['status'] = "Please select one or more items from status.";
            }
            if (empty($location)) {
                $Error['location'] = "Please select a choice from location.";
            }
        }
        ?>

        <h1>Form Validation Lab</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='post'>

            <?php
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                if (count($Error) !== 0) {
                    echo '<table class="error"><tr><td><p><span>Oops... the following errors were encountered: </span></p>';
                    echo "<ul>";
                    foreach ($Error as $KEY => $VAL) {
                        if (!(empty($VAL))) {
                            echo "<li>$VAL</li>";
                        }
                    }
                    echo "</ul>\n<p>Please correct the errors and re-submit this form.</p>\n</td>\n<tr>\n</table>";
                } else {
                    echo "<table class='success'><tr><td colspan='2'><p class='green'>Thankyou for your submission. You entered the following values: </p></td></tr>";
                    foreach ($_POST as $KEY => $VAL) {
                        if (is_array($VAL)) {
                            $VAL = implode(", ", $VAL);
                        }
                        if (empty($VAL)) {
                            $VAL = "---None supplied---";
                        }
                        $KEY = strtoupper($KEY);
                        echo "<tr><td class='key'>$KEY</td><td>$VAL</td></tr>";
                    }
                    echo '</table>';
                }
            } else {
                echo "<h3>Please fill in the form.........</h3>";
            }
            ?>


            <table class="submit">
                <tr  >
                    <td class="colempty">

                    </td>

                    <td>
                        <input type="submit" value="Submit This Form">
                    </td>
                    <td>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>">Start Again</a>
                    </td> 
                    <td>
                        <a href="">1</a>
                    </td>
                    <td>
                        <a href="">2</a>
                    </td>
                </tr>
            </table>


            <label>Note: Required fields are marked with an asterisk (<span>*</span>)</label>
            <br>
            <br>
            <fieldset>
                <legend>User Details</legend>
                <table>

                    <tr>
                        <td class="col1" >
                            <label>User Name<span>*</span></label>
                        </td>
                        <td >
                            <input <?php echo (empty($Error['name'])) ? "" : "class='error'"; ?> type="text" name='name' value="<?php echo $name; ?>">
                        </td> 
                        <td>
                            <label>(must be greater than 5 chars)</label>
                        </td>
                    </tr>

                    <tr >
                        <td class="col1" >
                            <label>Email Address</label>
                        </td>
                        <td>
                            <input type="email" name='email' value="<?php echo $email; ?>" >
                        </td>  
                        <td>

                        </td>
                    </tr>           
                </table>
            </fieldset>
            <br>
            <fieldset>
                <legend>Submission</legend>
                <table>

                    <tr>
                        <td class="col1">
                            <label>Year (YYYY)<span>*</span></label>
                        </td>   
                        <td>
                            <input <?php echo (empty($Error['year'])) ? "" : "class='error'"; ?> type="text" name='year' value="<?php echo $year; ?>" >
                        </td> 
                        <td>
                            <label>(4 digit number)</label>
                        </td>
                    </tr>

                    <tr>
                        <td class="col1" >
                            <label>Month(MM)<span>*</span></label>
                        </td>
                        <td>
                            <input <?php echo (empty($Error['month'])) ? "" : "class='error'"; ?> type="text" name='month' value="<?php echo $month; ?>" >
                        </td> 
                        <td>
                            <label>(number ranging from 1-12)</label>
                        </td> 
                    </tr>
                </table>
            </fieldset>
            <br>
            <fieldset>
                <legend>Preferences</legend>
                <table>
                    <tr>
                        <td class="col1">
                            <label>Province (Multiple Select)<span>*</span></label>
                        </td> 
                        <td>
                            <select name="province[]" <?php echo (empty($Error['province'])) ? "" : "class='error'"; ?>  multiple size="12">
                                <?php
                                foreach ($PROVINCES as $KEY => $VAL) {
                                    echo "<option value='$VAL'";
                                    if (in_array($VAL, $_POST["province"])) {
                                        echo " selected ";
                                    }
                                    echo ">$VAL</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr <?php echo (empty($Error['status'])) ? "" : "class='error'"; ?> >
                        <td class="col1" >
                            <label>Status (Mult Select)<span>*</span></label>
                        </td>
                        <td>
                            <input type="checkbox" name="status[]" value="Approved" <?php
                            if (in_array("Approved", $_POST["status"])) {
                                echo "checked";
                            }
                            ?> ><label>Approved</label>

                            <input type="checkbox" name="status[]" value="Pending Application" <?php
                            if (in_array("Pending Application", $_POST["status"])) {
                                echo "checked";
                            }
                            ?> ><label>Pending Application</label>

                            <input type="checkbox" name="status[]" value="Active Service" <?php
                            if (in_array("Active Service", $_POST["status"])) {
                                echo "checked";
                            }
                            ?> ><label>Active Service</label>
                        </td>

                    </tr>

                    <tr <?php echo (empty($Error['location'])) ? "" : "class='error'"; ?> >
                        <td class="col1" >
                            <label>Location<span>*</span></label>
                        </td>
                        <td>
                            <input type="radio" name="location" value="Garage" <?php
                            if ($_POST["location"] === 'Garage') {
                                echo " checked ";
                            }
                            ?> ><label>Garage</label>
                            <input type="radio" name="location" value="Attic"  
                            <?php
                            if ($_POST["location"] === 'Attic') {
                                echo " checked ";
                            }
                            ?> ><label>Attic</label>
                            <input type="radio" name="location" value="House" <?php
                            if ($_POST["location"] === 'House') {
                                echo " checked ";
                            }
                            ?> ><label>House</label>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </body>
</html>