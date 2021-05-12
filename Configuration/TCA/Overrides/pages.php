<?php

use HDNET\Autoloader\Utility\ArrayUtility;
use HDNET\Autoloader\Utility\ModelUtility;
use HDNET\CalendarizePages\EventRegister;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$GLOBALS['TCA']['pages'] = ModelUtility::getTcaOverrideInformation('calendarize_pages', 'pages');

$custom = [];

$GLOBALS['TCA']['pages'] = ArrayUtility::mergeRecursiveDistinct($GLOBALS['TCA']['pages'], $custom);


ExtensionManagementUtility::addTcaSelectItem(
    'pages',
    'doktype',
    [
        'Event',
        (string) EventRegister::DOKTYPE_EVENT,
        'calendarize-pages-extension',
    ],
    '1',
    'after'
);

\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
    $GLOBALS['TCA']['pages'],
    [
        'ctrl' => [
            'typeicon_classes' => [
                (string) EventRegister::DOKTYPE_EVENT => 'calendarize-pages-extension',
            ],
        ],
        'types' => [
            (string) EventRegister::DOKTYPE_EVENT => $GLOBALS['TCA']['pages']['types'][\TYPO3\CMS\Core\Domain\Repository\PageRepository::DOKTYPE_DEFAULT],
        ],
    ]
);

$GLOBALS['TCA']['pages']['types'][(string) EventRegister::DOKTYPE_EVENT]['columnsOverrides'] = [
    'calendarize' => [
        'config' => [
            'minitems' => 1,
        ],
    ],
];
