<?php 


$courseid = required_param('course', PARAM_INT); //The course ID

$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST); //Grab the course from the database using the course ID


?>