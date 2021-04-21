<?php

defined('TYPO3_MODE') || die();

\HDNET\Autoloader\Loader::extTables('HDNET', 'calendarize_pages');
\HDNET\Calendarize\Register::extTables(\HDNET\CalendarizePages\EventRegister::getConfigurationPages());

$GLOBALS['PAGES_TYPES'][\HDNET\CalendarizePages\EventRegister::DOKTYPE_EVENT] = [
    'type' => 'web',
    'allowedTables' => '*',
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
        options.pageTree.doktypesToShowInNewPageDragArea := addToList(' . \HDNET\CalendarizePages\EventRegister::DOKTYPE_EVENT . ')
    ');
$icons = [
    'calendarize-event-page' => 'EXT:calendarize_pages/Resources/Public/Icons/Extension.svg',
];
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
foreach ($icons as $identifier => $path) {
    $iconRegistry->registerIcon(
        $identifier,
        TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => $path]
    );
}
