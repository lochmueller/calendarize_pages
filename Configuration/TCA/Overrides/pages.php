<?php

use HDNET\Calendarize\Register;
use HDNET\CalendarizePages\Register as RegisterAlias;
use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// @deprecated Use 'label', 'value', icon' once dropping TYPO3 v11 (see TYPO3 deprecation: #99739)
ExtensionManagementUtility::addTcaSelectItem(
    'pages',
    'doktype',
    [
        'LLL:EXT:calendarize_pages/Resources/Private/Language/locallang_tca.xlf:pages.doktype.event',
        '132',
        'calendarize-pages-extension',
    ],
    '1',
    'after'
);

ArrayUtility::mergeRecursiveWithOverrule(
    $GLOBALS['TCA']['pages'],
    [
        'ctrl' => [
            'typeicon_classes' => [
                '132' => 'calendarize-pages-extension',
            ],
        ],
        'types' => [
            '132' => $GLOBALS['TCA']['pages']['types'][PageRepository::DOKTYPE_DEFAULT],
        ],
    ]
);

Register::createTcaConfiguration(RegisterAlias::getConfiguration());

$GLOBALS['TCA']['pages']['types']['132']['columnsOverrides'] = [
    'calendarize' => [
        'config' => [
            'minitems' => 1,
        ],
    ],
];

$additionalTCAcolumns = [
    'location' => [
        'exclude' => true,
        'label' => 'LLL:EXT:calendarize/Resources/Private/Language/locallang.xlf:tx_calendarize_domain_model_event.location',
        'config' => [
            'type' => 'input',
        ],
    ],
    'location_link' => [
        'exclude' => true,
        'label' => 'LLL:EXT:calendarize/Resources/Private/Language/locallang.xlf:tx_calendarize_domain_model_event.location_link',
        'config' => [
            'type' => 'link',
        ],
    ],
    'organizer' => [
        'exclude' => true,
        'label' => 'LLL:EXT:calendarize/Resources/Private/Language/locallang.xlf:tx_calendarize_domain_model_event.organizer',
        'config' => [
            'type' => 'input',
        ],
    ],
    'organizer_link' => [
        'exclude' => true,
        'label' => 'LLL:EXT:calendarize/Resources/Private/Language/locallang.xlf:tx_calendarize_domain_model_event.organizer_link',
        'config' => [
            'type' => 'link',
        ],
    ],
];

$GLOBALS['TCA']['pages'] = [
    'palettes' => [
        'location' => [
            'showitem' => 'location,location_link',
        ],
        'organizer' => [
            'showitem' => 'organizer,organizer_link',
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns(
    'pages',
    $additionalTCAcolumns
);

ExtensionManagementUtility::addToAllTCAtypes(
    'pages',
    '--palette--;;location, --palette--;;organizer',
    '132',
    'before:calendarize'
);
