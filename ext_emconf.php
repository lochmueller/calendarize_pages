<?php

/**
 * $EM_CONF.
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Calendarize - Pages',
    'description' => 'Add pages to EXT:calendarize',
    'category' => 'fe',
    'version' => '3.2.0',
    'state' => 'beta',
    'clearcacheonload' => 1,
    'author' => 'Tim Lochmüller',
    'author_email' => 'tim@fruit-lab.de',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.6-10.4.99',
            'php' => '7.3.0-7.4.99',
            'calendarize' => '10.0.0-11.99.99',
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'HDNET\\CalendarizePages\\' => 'Classes/'
        ],
    ],
];
