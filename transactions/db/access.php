<?php
defined('MOODLE_INTERNAL') || die();

$capabilities = array(
    'report/transactions:view' => array(
        'riskbitmask' => RISK_CONFIG,
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'administrator' => CAP_ALLOW
        ),
    )
);
?>