<?php

use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

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

$GLOBALS['TCA']['pages']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['pages']['columns'],
    [
        'calendarize' => [
            'label' => 'Calendarize',
            'l10n_mode' => 'exclude',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_calendarize_domain_model_configuration',
                'minitems' => 0,
                'maxitems' => 99,
                'behaviour' => [
                    'enableCascadingDelete' => true,
                ],
            ],
        ],
        'calendarize_info' => [
            'label' => 'LLL:EXT:calendarize/Resources/Private/Language/locallang.xlf:tca.information',
            'config' => [
                'type' => 'none',
                'renderType' => 'calendarizeInfoElement',
                'parameters' => [
                    'items' => 10,
                ],
            ],
        ],
    ]
);

$GLOBALS['TCA']['pages']['types']['132']['columnsOverrides'] = [
    'calendarize' => [
        'config' => [
            'minitems' => 1,
        ],
    ],
];

ExtensionManagementUtility::addToAllTCAtypes(
    'pages',
    'calendarize, calendarize_info',
    '132',
    'after:subtitle'
);
