<?php

declare(strict_types=1);

namespace HDNET\CalendarizePages;

use HDNET\CalendarizePages\Domain\Model\Page;

class Register
{
    public static function getConfiguration(): array
    {
        return [
            'uniqueRegisterKey' => 'CalendarizePages',
            'title' => 'Calendarize Page',
            'modelName' => Page::class,
            'partialIdentifier' => 'CalendarizePages',
            'tableName' => 'pages',
            'required' => false,
            'tcaTypeList' => '132',
            'tcaPosition' => 'after:subtitle',
        ];
    }
}
