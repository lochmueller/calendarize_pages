<?php

declare(strict_types=1);

namespace HDNET\CalendarizePages\EventListener;

use HDNET\Calendarize\Event\IndexRepositoryFindBySearchEvent;
use HDNET\CalendarizePages\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class IndexRepositorySearchListener
{
    public function __invoke(IndexRepositoryFindBySearchEvent $event): void
    {
        if (!in_array('CalendarizePages', $event->getIndexTypes(), true)) {
            return;
        }

        $customSearch = $event->getCustomSearch();
        $fullText = trim($customSearch['fullText'] ?? '');
        $category = (int)($customSearch['category'] ?? 0);
        if ($fullText === '' && $category === 0) {
            return;
        }

        $pageRepository = GeneralUtility::makeInstance(PageRepository::class);
        $searchTermHits = $pageRepository->getIdsBySearch($fullText, $category);
        if ($searchTermHits && \count($searchTermHits)) {
            $indexIds = $event->getIndexIds();
            $indexIds['pages'] = $searchTermHits;
            $event->setIndexIds($indexIds);
        }
    }
}
