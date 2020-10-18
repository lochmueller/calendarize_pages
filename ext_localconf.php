<?php

defined('TYPO3_MODE') || die();

\HDNET\Autoloader\Loader::extLocalconf('HDNET', 'calendarize_pages');
\HDNET\Calendarize\Register::extLocalconf(\HDNET\CalendarizePages\EventRegister::getConfigurationPages());
