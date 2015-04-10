<?php
/*
 * This page sets up the basic page that moodle requires to place a form object. The Form file contains the actual
 * display information.
 */
require_once('../../config.php');
require_once('credit_form.php');

global $DB, $OUTPUT, $PAGE;

//Sets up a default page with navigation features et al
$PAGE -> set_url('/blocks/discount/credit/view.php', array('id' => $courseid));
$PAGE -> set_pagelayout('standard');
$PAGE -> set_heading("Credits");

//Check for the required variables
$blockid = required_param('blcokid', PARAM_INT);

//Check for optional variables
$id = optional_param('id', 0, PARAM_INT);

$credit = new credit_form();
echo $OUTPUT -> header();
$credit -> display();
echo $OUTPUT -> footer();

$credit->display();
?>