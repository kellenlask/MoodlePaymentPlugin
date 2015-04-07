<?php

/*
 * @package    enrol_payment
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

    // --- settings ------------------------------------------------------------------------------------------
    $settings->add(new admin_setting_heading('enrol_payment_settings', '', get_string('pluginname_desc', 'enrol_payment')));

    $settings->add(new admin_setting_configcheckbox('enrol_payment/mailstudents', get_string('mailstudents', 'enrol_payment'), '', 0));

    $settings->add(new admin_setting_configcheckbox('enrol_payment/mailteachers', get_string('mailteachers', 'enrol_payment'), '', 0));

    $settings->add(new admin_setting_configcheckbox('enrol_payment/mailadmins', get_string('mailadmins', 'enrol_payment'), '', 0));

    //  Note: let's reuse the ext sync constants and strings here, internally it is very similar,
    //        it describes what should happen when users are not supposed to be enrolled any more.
    $options = array(
        ENROL_EXT_REMOVED_KEEP           => get_string('extremovedkeep', 'enrol'),
        ENROL_EXT_REMOVED_SUSPENDNOROLES => get_string('extremovedsuspendnoroles', 'enrol'),
        ENROL_EXT_REMOVED_UNENROL        => get_string('extremovedunenrol', 'enrol'),
    );
    $settings->add(new admin_setting_configselect('enrol_payment/expiredaction', get_string('expiredaction', 
    'enrol_payment'), get_string('expiredaction_help', 'enrol_payment'), ENROL_EXT_REMOVED_SUSPENDNOROLES, $options));

    // --- enrol instance defaults ----------------------------------------------------------------------------
    $settings->add(new admin_setting_heading('enrol_payment_defaults',
        get_string('enrolinstancedefaults', 'admin'), get_string('enrolinstancedefaults_desc', 'admin')));

    $settings->add(new admin_setting_configtext('enrol_payment/cost', get_string('cost', 'enrol_payment'), '', 0, PARAM_FLOAT, 4));

    $settings->add(new admin_setting_configcheckbox('enrol_payment/customint1', get_string('subscribe', 'enrol_payment'), '', 0));

    if (!during_initial_install()) {
        $options = get_default_enrol_roles(context_system::instance());
        $student = get_archetype_roles('student');
        $student = reset($student);
        $settings->add(new admin_setting_configselect('enrol_payment/roleid',
            get_string('defaultrole', 'enrol_payment'), get_string('defaultrole_desc', 'enrol_payment'), $student->id, $options));
    }

    $settings->add(new admin_setting_configduration('enrol_payment/enrolperiod',
        get_string('enrolperiod', 'enrol_payment'), get_string('enrolperiod_desc', 'enrol_payment'), 604800));
}
