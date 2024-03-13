<?php

defined('TYPO3') || die();

$GLOBALS['PAGES_TYPES'][132] = [
    'type' => 'web',
    'allowedTables' => '*',
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
    options.pageTree.doktypesToShowInNewPageDragArea := addToList(132)
');
