<?php
/*
 * This plugin allows you to set up a course shop and shopping cart
 *
 * @package    enrol_payment
 */


require('../../config.php');
require_once('edit_form.php');

$courseid   = required_param('courseid', PARAM_INT);
$instanceid = optional_param('id', 0, PARAM_INT); //  instanceid

$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
$context = context_course::instance($course->id, MUST_EXIST);

require_login($course);
require_capability('enrol/payment:config', $context);

$PAGE->set_url('/enrol/payment/edit.php', array('courseid' => $course->id, 'id' => $instanceid));
$PAGE->set_pagelayout('admin');

$return = new moodle_url('/enrol/instances.php', array('id' => $course->id));
if (!enrol_is_enabled('payment')) {
    redirect($return);
}

$plugin = enrol_get_plugin('payment');

if ($instanceid) {
    $instance = $DB->get_record('enrol', array('courseid' => $course->id, 'enrol' => 'payment', 'id' => $instanceid), '*', MUST_EXIST);
    $instance->cost = format_float($instance->cost, 2, true);
} else {
    require_capability('moodle/course:enrolconfig', $context);
    //  no instance yet, we have to add new instance
    navigation_node::override_active_url(new moodle_url('/enrol/instances.php', array('id' => $course->id)));
    $instance = new stdClass();
    $instance->id       = null;
    $instance->courseid = $course->id;
}

$mform = new enrol_payment_edit_form(null, array($instance, $plugin, $context));

if ($mform->is_cancelled()) {
    redirect($return);

} else if ($data = $mform->get_data()) {
    if ($instance->id) {
        $reset = ($instance->status != $data->status);

        $instance->status         = $data->status;
        $instance->name           = $data->name;
        $instance->cost           = unformat_float($data->cost);
        $instance->customint1     = $data->customint1;
        $instance->roleid         = $data->roleid;
        $instance->enrolperiod    = $data->enrolperiod;
        $instance->enrolstartdate = $data->enrolstartdate;
        $instance->enrolenddate   = $data->enrolenddate;
        $instance->timemodified   = time();
        $DB->update_record('enrol', $instance);

        if ($reset) {
            $context->mark_dirty();
        }

    } else {
        $fields = array('status' => $data->status, 'name' => $data->name, 'cost' => unformat_float($data->cost), 'customint1' => $data->customint1, 'roleid' => $data->roleid,
                        'enrolperiod' => $data->enrolperiod, 'enrolstartdate' => $data->enrolstartdate, 'enrolenddate' => $data->enrolenddate);
        $plugin->add_instance($course, $fields);
    }
    redirect($return);
}

$PAGE->set_heading($course->fullname);
$PAGE->set_title(get_string('pluginname', 'enrol_payment'));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'enrol_payment'));
$mform->display();
echo $OUTPUT->footer();
