<?php
/**

 * This plugin allows you to set up a course shop and shopping cart
 * @package    enrol_payment
 */

/**
 * upgrade from old version
 */

require_once('../../../config.php');
require_once('../../../course/lib.php');
require_once('../../../lib/filelib.php');

global $DB, $OUTPUT, $PAGE, $COURSE;

if(! $DB->record_exists('enrol_payment', array())) {
    $record = new stdClass();
    $record->authkey = optional_param('keyval', null, PARAM_TEXT);;
    $insert = $DB->insert_record('enrol_payment', $record, false);
    header("Location: ".$CFG->wwwroot."/enrol/payment/shop.php");
    die();
}