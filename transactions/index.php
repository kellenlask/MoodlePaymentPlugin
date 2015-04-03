<?php

require_once('../../config.php');
require($CFG->dirroot.'/report/transactions/locallib.php'); //This is the file with all of our hefty code
require_once($CFG->libdir . '/adminlib.php');
require_once("{$CFG->libdir}/csvlib.class.php");
global $CFG, $PAGE;
TABLE="";
//Require Login and admin 
require_login();
isadmin();

//Page Definitions
define('DEFAULT_PAGE_SIZE', 20);
define('SHOW_ALL_PAGE_SIZE', 5000);

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Transactions Reporting');
$PAGE->set_heading('Transactions Reporting');
$PAGE->set_url($CFG->wwwroot.'/report/transactions/index.php');
echo $OUTPUT->header();

?>

<form method="post" action="post.php">
    <h2>Get Transaction Records for the Time Period...</h2><br>
	FROM:
	<select name="startMonth" >
		<option value="01">January</option>
		<option value="02">February</option>
		<option value="03">March</option>
		<option value="04">April</option>
		<option value="05">May</option>
		<option value="06">June</option>
		<option value="07">July</option>
		<option value="08">August</option>
		<option value="09">September</option>
		<option value="10">October</option>
		<option value="11">November</option>
		<option value="12">December</option>
	</select>
	<input name="startYear" type="number" min="2002" max="3000" />
	TO:
	<select name="endMonth" >
		<option value="01">January</option>
		<option value="02">February</option>
		<option value="03">March</option>
		<option value="04">April</option>
		<option value="05">May</option>
		<option value="06">June</option>
		<option value="07">July</option>
		<option value="08">August</option>
		<option value="09">September</option>
		<option value="10">October</option>
		<option value="11">November</option>
		<option value="12">December</option>
	</select>
	<input name="endYear" type="number" min="2002" max="3000" />
        <br>
        <input type="submit" value="Download Records">
</form>

<?php
//Depending on how demanding the reporting is, this may need to be in effect.
//raise_memory_limit(MEMORY_EXTRA);
//core_php_time_limit::raise();

// Trigger a content view event.
$event = \report_stats\event\report_viewed::create(array('context' => $context, 'relateduserid' => $userid,
        'other' => array('report' => $report, 'time' => $time, 'mode' => $mode)));
$event->trigger();

function get_form_information() {
	$startMonth = $_POST['startMonth'];
	$startYear = $_POST['startYear'];
	$endMonth = $_POST['endMonth'];
	$endYear = $_POST['endYear'];
        
        return array($startMonth, $startYear, $endMonth, $endYear);
}

function get_data($startYear, $startMonth, $endYear, $endMonth) {
    $where_query = 'date between \''.$startYear.'-'.$startMonth.'-00\' AND \''.$endYear.'-'.$endMonth.'-00\''; //Moodle auto-inserts the "WHERE" keyword
    $list = $DB -> get_records_select(TABLE, $where_query);    
    
    return $list;
} //End get_data

//Given a start date, an end date and a file location, dump the transaction history into the .csv
function make_csv($list, $location) {
        
    $file = fopen($location."report.csv", "w");

    foreach ($list as $line) {
        fputcsv($file, explode(',', $line));
    }

    fclose($file);
}//End make_csv

echo $OUTPUT->footer();

?>