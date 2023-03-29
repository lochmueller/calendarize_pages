<?php

$GLOBALS['TYPO3_CONF_VARS']['EXT']['Calendarize']['CalendarizePages'] = [
    'uniqueRegisterKey' => 'CalendarizePages',
    'title' => 'Calendarize Page',
    'modelName' => \HDNET\CalendarizePages\Domain\Model\Page::class,
    'partialIdentifier' => 'CalendarizePages',
    'tableName' => 'pages',
    'required' => false,
];
