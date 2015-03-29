<?php
/*
 * This page sets up the basic page that moodle requires to place a form object. The Form file contains the actual
 * display information.
 */
require_once('../../config.php');
require_once('discount_form.php');

global $DB, $OUTPUT, $PAGE;

//Sets up a default page with navigation features et al
$PAGE -> set_url('/blocks/discount/view.php', array('id' => $courseid));
$PAGE -> set_pagelayout('standard');
$PAGE -> set_heading(get_string('pluginname', 'block_discount'));

//Check for the required variables
$discount_code = required_param('discountcode', PARAM_BLOB);
$blockid = required_param('blcokid', PARAM_INT);

//Check for optional variables
$id = optional_param('id', 0, PARAM_INT);

$discount = new discount_form();
echo $OUTPUT -> header();
$discount -> display();
echo $OUTPUT -> footer();

$discount->display();
?>