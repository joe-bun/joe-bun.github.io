<!DOCTYPE html>
<!--Jobanpreet Singh Aulakh, 000381413-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
            form, h1,h2,p,nav,span,ol{text-align:center;}
            body{
                width:30%;
            }
        </style>
    </head>
    <body>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "<p> $ _ POST ";
            print_r($_POST);
            echo "</p>";

            $allTheGuesses = $_POST['allTheGuesses'] . $_POST['UserInput'] . " | ";
        }
        ?>
        <nav>

            <?php
            $wordChoices = array("grape", "apple", "orange", "banana", "plum", "grapefruit");
            $rightWord = $wordChoices[2];
            for ($i = 0; $i < count($wordChoices); $i++) {
                if ($wordChoices[$i] === $rightWord) {
                    echo "<span style='color:green;'>$wordChoices[$i]</span>";
                } else {
                    echo "$wordChoices[$i]";
                }if ($i != count($wordChoices) - 1) {
                    echo" | ";
                }
            }
            ?>
        </nav>
        <h1> Word Guess </h1><br/>
        <a href= "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" >
            <p>Refresh this page</p>
        </a><br>
        <h2>Guess the word I'm thinking</h2><br>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <input name="UserInput" type="text" value="<?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo $_POST['UserInput'];
            }
            ?>">

            <input type="submit" value="GUESS">
            <p style="color:red;">
                <?php
                $_POST["allTheGuesses"] = array();
                if (isset($_POST['UserInput'])) {

                    if ($_POST["UserInput"] === $rightWord) {
                        echo "You guessed $rightWord and that's CORRECT!!! (3)";
                    } else if ((count($_POST) > 0) && (empty($_POST["UserInput"]))) {
                        echo "Come on, enter something (2)";
                    } else if (($_POST["UserInput"] !== $rightWord) && in_array($_POST["UserInput"], $wordChoices)) {
                        echo "Sorry $_POST[UserInput] is wrong. Try again (4)";
                    } else
                    if (!in_array($_POST["UserInput"], $wordChoices)) {
                        echo "Hey, that's not even a valid guess. Try again (5).";
                    }
                } else {
                    echo "It's time to play the guessing game! (1)";
                }
                ?>
            </p>
            <input name = "allTheGuesses" type="hidden" Value=" <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    echo $allTheGuesses;
                }
                ?>">
        </form>
        <span style="color:green;" >
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<p>Your Guesses:</p><ol>";
                $a = explode(" | ", $allTheGuesses);
                for ($i = 0; $i < count($a) - 1; $i++) {
                    if (!(empty($a[$i])))
                        echo "<li>$a[$i]</li>";
                }
                echo"</ol>";
            }
            ?>
        </span>
    </body>
</html>

