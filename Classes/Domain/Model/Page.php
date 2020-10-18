<?php

namespace HDNET\CalendarizePages\Domain\Model;

use HDNET\Autoloader\Annotation\DatabaseTable;

/**
 * @DatabaseTable("pages")
 */
class Page extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * @var string
     */
    protected $title = '';

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
