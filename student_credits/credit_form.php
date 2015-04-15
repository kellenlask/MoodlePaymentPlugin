<?php
/*
 * This is the block's form elements code along with the code to respond to their interaction. 
 */


require_once("{$CFG->libdir}/formslib.php");

class credit_form extends moodleform {
    function definition() {
		global $CFG, $USER, $OUTPUT;		
        //Header
        $mform =& $this->_form;
        $mform->addElement('header', 'displayinfo', get_string('pluginname', 'block_credit'));
        
        //Breadcrumbs
        $settingsnode = $PAGE -> settingsnav -> add(get_string('creditsettings', 'block_credit')); 
        $editurl = new moodle_url('/blocks/discount/credit/view.php', array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
        $editnode = $settingsnode -> add(get_string('edit_page', block_credit), $editurl);
        $editnode -> make_active();
        
		//Form Elements			
		//Selection Box of courses
		$mform->addElement('text', 'user', "Username", $options);		
		$mform->addElement('text', 'amount', "Amount:", $attributes);
		
		$mform->addRule( 'user', 'You must enter a user', 'required' );
		
		add_action_buttons($cancel = false, $submitlabel="Save");
		
        
    }
	
	function validation($data, $files) {
		$errors= array();
		if (empty($data['amount']) or floatval($data['amount']) <= 0){
            $errors['amount'] = "Must enter a valid amount.");
			
        } elseif(!user_exists($data['user'])) {
			$errors['user'] = "Must enter a valid username.");
			
		} else {
			$table = "credits";
			$dataobject = array('username' => $data['user'], 'creditamount' => floatval($data['amount']));
			$DB->add_record($table, $dataobject, $bulk=false);
		}	
		
        return $errors;	
		
	}
}
?>