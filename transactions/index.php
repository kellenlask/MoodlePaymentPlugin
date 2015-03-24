<?php

require('../../config.php');
require_once('../../adminlib.php'); //This path might be wrong


define('DEFAULT_PAGE_SIZE', 20);
define('SHOW_ALL_PAGE_SIZE', 5000);

//$id         = required_param('id', PARAM_INT); // course id.
//$roleid     = optional_param('roleid', 0, PARAM_INT); // which role to show
//$instanceid = optional_param('instanceid', 0, PARAM_INT); // instance we're looking at.
//$timefrom   = optional_param('timefrom', 0, PARAM_INT); // how far back to look...
//$action     = optional_param('action', '', PARAM_ALPHA);
//$page       = optional_param('page', 0, PARAM_INT);                     // which page to show
//$perpage    = optional_param('perpage', DEFAULT_PAGE_SIZE, PARAM_INT);  // how many per page
//$currentgroup = optional_param('group', null, PARAM_INT); // Get the active group.

$url = new moodle_url('/admin/report/transactions/index.php', array('id' => $id));
