<?php

declare(strict_types=1);

namespace HDNET\CalendarizePages\Slots;

use HDNET\CalendarizePages\Domain\Repository\PageRepository;
use HDNET\Autoloader\Annotation\SignalClass;
use HDNET\Autoloader\Annotation\SignalName;
use HDNET\CalendarizePages\EventRegister;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Event search service.
 */
class EventSearch
{
    /**
     * Check if we can reduce the amount of results.
     *
     * @SignalClass(value="HDNET\Calendarize\Domain\Repository\IndexRepository")
     * @SignalName(value="findBySearchPre")
     *
     * @param array $indexIds
     * @param \DateTime|null $startDate
     * @param \DateTime|null $endDate
     * @param array $customSearch
     * @param array $indexTypes
     * @param bool $emptyPreResult
     * @param array $additionalSlotArguments
     *
     * @return array|void
     */
    public function setIdsByCustomSearch(
        array $indexIds,
        \DateTime $startDate = null,
        \DateTime $endDate = null,
        array $customSearch = [],
        array $indexTypes = [],
        bool $emptyPreResult = false,
        array $additionalSlotArguments = []
    )
    {
        if (!\in_array($this->getUniqueRegisterKey(), $indexTypes, true)) {
            return;
        }

        if (!isset($customSearch['fullText']) || !$customSearch['fullText']) {
            return;
        }

        $pageRepository = GeneralUtility::makeInstance(ObjectManager::class)->get(PageRepository::class);
        $searchTermHits = $pageRepository->getIdsBySearchTerm($customSearch['fullText']);
        if ($searchTermHits && \count($searchTermHits)) {
            $indexIds['pages'] = $searchTermHits;
        }


        return [
            'indexIds' => $indexIds,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'customSearch' => $customSearch,
            'indexTypes' => $indexTypes,
            'emptyPreResult' => $emptyPreResult,
            'additionalSlotArguments' => $additionalSlotArguments,
        ];
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
