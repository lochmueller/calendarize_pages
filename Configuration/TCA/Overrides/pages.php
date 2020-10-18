<?php

use HDNET\Autoloader\Utility\ArrayUtility;
use HDNET\Autoloader\Utility\ModelUtility;

$GLOBALS['TCA']['pages'] = ModelUtility::getTcaOverrideInformation('calendarize_pages', 'pages');

$custom = [
];

$GLOBALS['TCA']['pages'] = ArrayUtility::mergeRecursiveDistinct($GLOBALS['TCA']['pages'], $custom);
