<?php
$x = "{'name':";
if (preg_match("/[0-9]+/", $_REQUEST['name'])) {
    $x += "error";
} else if (preg_match("/^(Harry Potter|Hermione Granger)/i", $_REQUEST['name'])) {
    $x += "warning";
} else {
    $x += "valid";
}

$x += ",'id':";

if (!preg_match("/[0-9]+/", $_REQUEST['id'])) {
    $x += "error";
} else if (preg_match("/(000+|111+|222+|333+|444+|555+|666+|777+|888+|999+)/", $_REQUEST['id'])) {
    $x += "warning";
} else {
    $x += "valid";
}

$x += ",'program':";

if (!preg_match("/(Geology|Microbiology)/", $_REQUEST['program'])) {
    $x += "error";
} else if (preg_match("(Basket Weaving|Beanstalk Climbing)/", $_REQUEST['program'])) {
    $x += "warning";
} else {
    $x += "valid";
}

$x += "}";
$y= json_encode($x);
echo $y;
?>