<?php

defined('TYPO3_MODE') || die();

\HDNET\Autoloader\Loader::extLocalconf('HDNET', 'calendarize_pages', \HDNET\CalendarizePages\EventRegister::getAutoloaderConfiguration());
\HDNET\Calendarize\Register::extLocalconf(\HDNET\CalendarizePages\EventRegister::getConfigurationPages());

$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon('calendarize-pages-extension', \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class, ['source' => 'EXT:calendarize_pages/Resources/Public/Icons/Extension.svg']);
