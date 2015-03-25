<?php

/**
 * @package   block_discounts
 * @copyright 2014, You Name <your@email.address>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

$plugin->version = 2015030200; // The current module version (Date: YYYYMMDDXX)
$plugin->requires = 2014051200; // Requires this Moodle version
$plugin->cron = 0; // Period for cron to check this module (secs)
$plugin->component = 'mod_certificate';
$plugin->maturity = MATURITY_STABLE;
$plugin->release = 'Stable';

/*$plugin->dependencies = array(
    'mod_forum' => ANY_VERSION,
    'mod_data'  => TODO);
*/

?>