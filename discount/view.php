<?php
require_once('../../config.php');
require_once('discount_form.php');

global $DB;

//Check for the required variables
$discount_code = required_param('discountcode', PARAM_BLOB);



$discount = new discount_form();

$discount->display();
?>