<?php

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') || die();

$GLOBALS['PAGES_TYPES'][132] = [
    'type' => 'web',
    'allowedTables' => '*',
];

if (GeneralUtility::makeInstance(Typo3Version::class)->getMajorVersion() <= 12) {
    ExtensionManagementUtility::addUserTSConfig('
        @import \'EXT:calendarize_pages/Configuration/user.tsconfig\'
    ');
}