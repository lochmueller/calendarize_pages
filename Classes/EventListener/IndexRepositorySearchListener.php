<?php
/**
 * Event register
 */
declare(strict_types=1);

namespace HDNET\CalendarizePages\EventListener;

use HDNET\Calendarize\Event\IndexRepositoryFindBySearchEvent;
use HDNET\CalendarizePages\Domain\Repository\PageRepository;
use HDNET\CalendarizePages\EventRegister;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class IndexRepositorySearchListener
{

    public function __invoke(IndexRepositoryFindBySearchEvent $event)
    {
        if (!\in_array($this->getUniqueRegisterKey(), $event->getIndexTypes(), true)) {
            return;
        }

        $customSearch = $event->getCustomSearch();
        if (!isset($customSearch['fullText']) || !$customSearch['fullText']) {
            return;
        }

        $pageRepository = GeneralUtility::makeInstance(ObjectManager::class)->get(PageRepository::class);
        $searchTermHits = $pageRepository->getIdsBySearchTerm($customSearch['fullText']);
        if ($searchTermHits && \count($searchTermHits)) {
            $indexIds = $event->getIndexIds();
            $indexIds['pages'] = $searchTermHits;
            $event->setIndexIds($indexIds);
        }

    }

    /**
     * Unique register key.
     *
     * @return string
     */
    protected function getUniqueRegisterKey()
    {
        $config = EventRegister::getConfigurationPages();

        return $config['uniqueRegisterKey'];
    }

}
