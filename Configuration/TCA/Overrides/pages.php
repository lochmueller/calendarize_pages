<?php

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

\HDNET\Calendarize\Register::createTcaConfiguration(\HDNET\CalendarizePages\Register::getConfiguration());

$GLOBALS['TCA']['pages']['types']['132']['columnsOverrides'] = [
    'calendarize' => [
        'config' => [
            'minitems' => 1,
        ],
    ],
];
