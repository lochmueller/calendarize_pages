<?php

use HDNET\Autoloader\Utility\ArrayUtility;
use HDNET\Autoloader\Utility\ModelUtility;

$GLOBALS['TCA']['pages'] = ModelUtility::getTcaOverrideInformation('calendarize_pages', 'pages');

$custom = [];

$GLOBALS['TCA']['pages'] = ArrayUtility::mergeRecursiveDistinct($GLOBALS['TCA']['pages'], $custom);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'pages',
    'doktype',
    [
        'Event',
        (string) \HDNET\CalendarizePages\EventRegister::DOKTYPE_EVENT,
        'calendarize-event-page',
    ],
    '1',
    'after'
);

\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
    $GLOBALS['TCA']['pages'],
    [
        'ctrl' => [
            'typeicon_classes' => [
                (string) \HDNET\CalendarizePages\EventRegister::DOKTYPE_EVENT => 'calendarize-event-page',
            ],
        ],
        'types' => [
            (string) \HDNET\CalendarizePages\EventRegister::DOKTYPE_EVENT => $GLOBALS['TCA']['pages']['types'][\TYPO3\CMS\Core\Domain\Repository\PageRepository::DOKTYPE_DEFAULT],
        ],
    ]
);

$GLOBALS['TCA']['pages']['types'][(string) \HDNET\CalendarizePages\EventRegister::DOKTYPE_EVENT]['columnsOverrides'] = [
    'calendarize' => [
        'config' => [
            'minitems' => 1,
        ],
    ],
];
