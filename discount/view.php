<?php
require_once('../../config.php');
require_once('discount_form.php');

global $DB, $OUTPUT, $PAGE;

//Sets up a default page with navigation features et al
$PAGE -> set_url('/blocks/discount/view.php', array('id' => $courseid));
$PAGE -> set_pagelayout('standard');
$PAGE -> set_heading(get_string('pluginname', 'block_discount'));

//Check for the required variables
$discount_code = required_param('discountcode', PARAM_BLOB);



$discount = new discount_form();

$discount->display();
?>