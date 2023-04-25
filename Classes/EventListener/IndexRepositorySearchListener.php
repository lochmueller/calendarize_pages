<?php

declare(strict_types=1);

namespace HDNET\CalendarizePages\EventListener;

use HDNET\Calendarize\Domain\Model\Dto\Search;
use HDNET\Calendarize\Event\IndexRepositoryFindBySearchEvent;
use HDNET\CalendarizePages\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

class IndexRepositorySearchListener
{
    public function __construct(protected PageRepository $pageRepository)
    {
    }

    public function __invoke(IndexRepositoryFindBySearchEvent $event): void
    {
        if (!in_array('CalendarizePages', $event->getIndexTypes(), true)) {
            return;
        }

        $search = $this->getSearchDto($event);

        if (!$search->isSearch()) {
            return;
        }

        /** @var Typo3QuerySettings $querySettings */
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $this->pageRepository->setDefaultQuerySettings($querySettings);
        $searchTermIds = $this->pageRepository->findBySearch($search->getFullText(), $search->getCategories());

        // Blocks result (displaying no event) on no search match (empty id array)
        $searchTermIds[] = -1;

        $indexIds = $event->getIndexIds();
        $indexIds['pages'] = $searchTermIds;
        $event->setIndexIds($indexIds);
    }

    protected function getSearchDto(IndexRepositoryFindBySearchEvent $event): Search
    {
        $customSearch = $event->getCustomSearch();

        $search = new Search();
        $search->setFullText(trim((string)($customSearch['fullText'] ?? '')));

        if (is_array($customSearch['categories'])) {
            $categories = array_map('intval', $customSearch['categories']);
            $search->setCategories($categories);
        } elseif (MathUtility::canBeInterpretedAsInteger($customSearch['category'] ?? '')) {
            // Fallback for previous mode
            $search->setCategories([(int)$customSearch['category']]);
        }

        return $search;
    }
}
