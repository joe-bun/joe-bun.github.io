<?php
// Return JSON default data if requested
if ($_REQUEST['act'] == 'default') {
    $defaultData = array('name' => "Jane",
        'postal' => "L5B4G6",
        'phone' => "9055751212",
        'address' => "135 Fennel Street");

    echo json_encode($defaultData);
}
// Validate the data, then return results of validation
else if ($_REQUEST['act'] == 'validate') {
    $validateData = array();

    if (preg_match("/^[A-Za-z]{3,20}$/", $_REQUEST['name']))
        $validateData['name'] = 1;
    else
        $validateData['name'] = 0;

    if (preg_match("/^[0-9]{10}$/", $_REQUEST['phone']))
        $validateData['phone'] = 1;
    else
        $validateData['phone'] = 0;

    if (preg_match("/^[A-Z][0-9][A-Z][0-9][A-Z][0-9]$/", $_REQUEST['postal']))
        $validateData['postal'] = 1;
    else
        $validateData['postal'] = 0;

    if (preg_match("/^[0-9]{3} [A-Za-z]{3,10} Street$/", $_REQUEST['address']))
        $validateData['address'] = 1;
    else
        $validateData['address'] = 0;

    echo json_encode($validateData);
} else
    echo "Should not happen";
?>