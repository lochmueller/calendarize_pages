<?php

/**
 * $EM_CONF.
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Calendarize - Pages',
    'description' => 'Add pages to EXT:calendarize',
    'category' => 'fe',
    'version' => '3.3.0',
    'state' => 'beta',
    'author' => 'Tim Lochmüller',
    'author_email' => 'tim@fruit-lab.de',
    'constraints' => [
        'depends' => [
            'typo3' => '12.0.0-12.5.99',
            'php' => '7.4.0-8.0.99',
            'calendarize' => '10.0.0-13.99.99',
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'HDNET\\CalendarizePages\\' => 'Classes/'
        ],
    ],
];
