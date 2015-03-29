<?php 
require_once('../../config.php');
require_once($CFG->libdir . '/adminlib.php');

$courseid = required_param('course', PARAM_INT); //The course ID
$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST); //Grab the course from the database using the course ID

//Require Login and admin 
require_login();
isadmin();

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Set Course Price');
$PAGE->set_heading('Set Course Price');
$PAGE->set_url($CFG->wwwroot.'/course/prices/index.php');
echo $OUTPUT->header();
?>

<form method="post" action="post.php">
        <h2>Set Course Price</h2><br>
        <label for="price">Cost: $</label> 
        <input name="price" type="number" min="0" max="1000" />
    
        <br>
        <input type="submit" value="Download Records">
</form>


<?php

// Trigger a content view event.
$event = \report_stats\event\report_viewed::create(array('context' => $context, 'relateduserid' => $userid,
        'other' => array('report' => $report, 'time' => $time, 'mode' => $mode)));
$event->trigger();



echo $OUTPUT->footer();

?>