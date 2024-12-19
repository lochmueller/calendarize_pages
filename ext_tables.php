<?php

use TYPO3\CMS\Core\Information\Typo3Version;

defined('TYPO3') || die();

$GLOBALS['PAGES_TYPES'][132] = [
    'type' => 'web',
    'allowedTables' => '*',
];

if (GeneralUtility::makeInstance(Typo3Version::class)->getMajorVersion() <= 12) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
        @import \'EXT:calendarize_pages/Configuration/user.tsconfig\'
    ');
}