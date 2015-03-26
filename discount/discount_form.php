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
        
        
    }
}
?>