<?php
/*
 * The Transactions portion of the Moodle Payment Plugin is meant to serve as the admin reporting
 * tool for behind the scenes, government tracking of the financial aspects of the transactions
 * processed by the Moodle payment plugin. This will involve reading the logs produced by the 
 * other payment plugin components -- mainly the payment and discount components.
 */
//-------------------------------------------------------------------------------------------------------------------
//
//          Moodle Extras
//
//-------------------------------------------------------------------------------------------------------------------

//Required Libraries
require('../../config.php');
require_once($CFG->dirroot.'/report/stats/locallib.php');
require_once($CFG->libdir.'/adminlib.php');

//Page Definitions
define('DEFAULT_PAGE_SIZE', 20);
define('SHOW_ALL_PAGE_SIZE', 5000);

//Variables of Import
//$id         = required_param('id', PARAM_INT); // course id.
//$roleid     = optional_param('roleid', 0, PARAM_INT); // which role to show
//$instanceid = optional_param('instanceid', 0, PARAM_INT); // instance we're looking at.
//$timefrom   = optional_param('timefrom', 0, PARAM_INT); // how far back to look...
//$action     = optional_param('action', '', PARAM_ALPHA);
//$page       = optional_param('page', 0, PARAM_INT);                     // which page to show
//$perpage    = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);  // how many per page
//$currentgroup = optional_param('group', null, PARAM_INT); // Get the active group.

//Require Admin Login
require_login();

//The page's URL
$url = new moodle_url('/admin/report/transactions/index.php', array('id' => $id));

//Depending on how demanding the reporting is, this may need to be in effect.
//raise_memory_limit(MEMORY_EXTRA);
//core_php_time_limit::raise();

//-------------------------------------------------------------------------------------------------------------------
//
//          Report Controls
//
//-------------------------------------------------------------------------------------------------------------------




//-------------------------------------------------------------------------------------------------------------------
//
//          Report Display
//
//-------------------------------------------------------------------------------------------------------------------



//-------------------------------------------------------------------------------------------------------------------
//
//          Logical Functions
//
//-------------------------------------------------------------------------------------------------------------------

//ToDo: complete this method: the code is generic from the internet -- needs to be adapted
//Given a start date, an end date and a file location, dump the transaction history into the .csv
function make_csv() {
    $num = 0;
    $results = $DB->get_records_list();
    if ($result = $mysqli->query($sql)) {
        while ($p = $result->fetch_array()) {
            $prod[$num]['id'] = $p['id'];
            $prod[$num]['name'] = $p['name'];
            $prod[$num]['description'] = $p['description'];
            $num++;
        }
    }
    
    $output = fopen("php://output", 'w') or die("Can't open php://output");
    header("Content-Type:application/csv");
    header("Content-Disposition:attachment;filename=pressurecsv.csv");
    fputcsv($output, array('id', 'name', 'description'));
    foreach ($prod as $product) {
        fputcsv($output, $product);
    }
    fclose($output);
} //End make_csv

?>