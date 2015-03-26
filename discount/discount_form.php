<?php
/*
 * This is the block's form elements code along with the code to respond to their interaction. 
 */


require_once("{$CFG->libdir}/formslib.php");

class discount_form extends moodleform {
    function definition() {
        //Header
        $mform =& $this->_form;
        $mform->addElement('header', 'displayinfo', get_string('pluginname', 'block_discount'));
        
        //Breadcrumbs
        $settingsnode = $PAGE -> settingsnav -> add(get_string('discountsettings', 'block_discount')); 
        $editurl = new moodle_url('/blocks/discount/view.php', array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
        $editnode = $settingsnode -> add(get_string('edit_page', block_discount), $editurl);
        $editnode -> make_active();
        
        
    }
}
?>