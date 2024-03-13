<?php

declare(strict_types=1);

namespace HDNET\CalendarizePages;

class Register
{
    public static function getConfiguration(): array
    {
        return [
            'uniqueRegisterKey' => 'CalendarizePages',
            'title' => 'Calendarize Page',
            'modelName' => \HDNET\CalendarizePages\Domain\Model\Page::class,
            'partialIdentifier' => 'CalendarizePages',
            'tableName' => 'pages',
            'required' => false,
            'tcaTypeList' => '132',
            'tcaPosition' => 'after:subtitle',
        ];
    }
}