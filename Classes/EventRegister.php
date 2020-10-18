<?php
/**
 * Event register
 */
declare(strict_types=1);

namespace HDNET\CalendarizePages;

use HDNET\CalendarizePages\Domain\Model\Page;

/**
 * Event register
 */
class EventRegister
{

    /**
     * @return array
     */
    public static function getConfigurationPages(): array
    {
        return [
            'uniqueRegisterKey' => 'CalendarizePages',
            'title' => 'Calendarize Page',
            'modelName' => Page::class,
            'partialIdentifier' => 'CalendarizePages',
            'tableName' => 'pages',
            'required' => false,
        ];
    }
}
