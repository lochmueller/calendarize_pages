<?php

namespace HDNET\CalendarizePages\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Page extends AbstractEntity
{
    protected string $title = '';

    protected string $subtitle = '';

    protected string $description = '';

    protected string $abstract = '';

    protected string $author = '';

    protected string $location = '';

    protected string $locationLink = '';

    protected string $organizer = '';

    protected string $organizerLink = '';

    /**
     * @var ObjectStorage<Category>
     */
    protected ObjectStorage $categories;

    /**
     * @var ObjectStorage<FileReference>
     */
    protected ObjectStorage $media;

    public function __construct()
    {
        $this->media = new ObjectStorage();
        $this->categories = new ObjectStorage();
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

    public function getMedia(): ObjectStorage
    {
        return $this->media;
    }

    public function setMedia(ObjectStorage $media): void
    {
        $this->media = $media;
    }

    public function getCategories(): ObjectStorage
    {
        return $this->categories;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getOrganizer(): string
    {
        return $this->organizer;
    }

    public function setOrganizer(string $organizer): void
    {
        $this->organizer = $organizer;
    }

    public function getLocationLink(): string
    {
        return $this->locationLink;
    }

    public function setLocationLink(string $locationLink): void
    {
        $this->locationLink = $locationLink;
    }

    public function getOrganizerLink(): string
    {
        return $this->organizerLink;
    }

    public function setOrganizerLink(string $organizerLink): void
    {
        $this->organizerLink = $organizerLink;
    }
}
