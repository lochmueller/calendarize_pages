<?php

defined('TYPO3_MODE') || die();

\HDNET\Autoloader\Loader::extTables('HDNET', 'calendarize_pages');
\HDNET\Calendarize\Register::extTables(\HDNET\CalendarizePages\EventRegister::getConfigurationPages());
