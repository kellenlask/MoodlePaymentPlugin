<?php

require_once('../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once("{$CFG->libdir}/csvlib.class.php");
global $CFG, $PAGE;

//Require Login and admin 
require_login();
isadmin();
define('DEFAULT_PAGE_SIZE', 20);
define('SHOW_ALL_PAGE_SIZE', 5000);

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Assign Purchase Credits');
$PAGE->set_heading('Assign Purchase Credits');
$PAGE->set_url($CFG->wwwroot.'/report/transactions/index.php');
echo $OUTPUT->header();
?>

<form method="post" action="post.php">
    <h2>Assign Purchase Credits</h2><br>
	<label for="userID">Student:</label>
	<input type="text" name="userID" maxLength="50" required="required" />
	
	<label for="creditAmount">Student:</label>
	<input type="number" name="creditAmount" maxLength="3" min="0" required="required" />
	
	<label for="comments">Student:</label>
	<input type="text" name="comments" maxLength="500" />
	
	<input type="submit" value="Commit" />
</form>

<?php

$formData = get_form_information();

$dataobject = array('username' => $formData[0], 'creditamount' => floatval($formData[1]), 'comments' => $formData[2]);
$DB->add_record($table, $dataobject, $bulk=false);


function get_form_information() {
	$userID = $_POST['userID'];
	$creditAmount = $_POST['creditAmount'];
	$comments = $_POST['comments'];
        
    return array($userID, $creditAmount, $comments);
}


echo $OUTPUT->footer();

?>