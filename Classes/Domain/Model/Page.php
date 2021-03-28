<?php

namespace HDNET\CalendarizePages\Domain\Model;

use HDNET\Autoloader\Annotation\DatabaseTable;
use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * @DatabaseTable("pages")
 */
class Page extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $subtitle = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $abstract = '';

    /**
     * @var string
     */
    protected $author = '';
    
    /**
     * Categories.
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    protected $categories;
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    
    protected $media;

    public function __construct()
    {
        $this->media = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->categories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    public function getAbstract(): string
    {
        return $this->abstract;
    }

    public function setAbstract(string $abstract): void
    {
        $this->abstract = $abstract;
    }
    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getMedia(): \TYPO3\CMS\Extbase\Persistence\ObjectStorage
    {
        return $this->media;
    }

    public function setMedia(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $media): void
    {
        $this->media = $media;
    }
    
    public function getCategories()
    {
        return $this->categories;
    }
}
