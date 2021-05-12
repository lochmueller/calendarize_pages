<?php

defined('TYPO3_MODE') || die();

\HDNET\Autoloader\Loader::extTables('HDNET', 'calendarize_pages', \HDNET\CalendarizePages\EventRegister::getAutoloaderConfiguration());
\HDNET\Calendarize\Register::extTables(\HDNET\CalendarizePages\EventRegister::getConfigurationPages());

$GLOBALS['PAGES_TYPES'][\HDNET\CalendarizePages\EventRegister::DOKTYPE_EVENT] = [
    'type' => 'web',
    'allowedTables' => '*',
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
    options.pageTree.doktypesToShowInNewPageDragArea := addToList(' . \HDNET\CalendarizePages\EventRegister::DOKTYPE_EVENT . ')
');
