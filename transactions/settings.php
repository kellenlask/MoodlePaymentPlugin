<?php
//Ensure only Admins can access this report.
$ADMIN->add('reports', new admin_externalpage('reporttransactions', get_string('configlog', 'report_transactions'), "$CFG->wwwroot/report/transactions/index.php"));
$settings = null;
?>