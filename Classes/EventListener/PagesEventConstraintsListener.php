<?php

declare(strict_types=1);

namespace HDNET\CalendarizePages\EventListener;

use HDNET\Calendarize\Domain\Model\PluginConfiguration;
use HDNET\Calendarize\Event\IndexRepositoryDefaultConstraintEvent;
use HDNET\Calendarize\Utility\HelperUtility;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;

/**
 * @deprecated Remove when dropping TYPO3 v11
 */
class PagesEventConstraintsListener
{
    public function __invoke(IndexRepositoryDefaultConstraintEvent $event): void
    {
        if (GeneralUtility::makeInstance(Typo3Version::class)->getMajorVersion() >= 12) {
            // Calendarize v13 and later handles this for all custom events with the category field 'categories'
            return;
        }
        if (!empty($event->getIndexTypes()) && !in_array('CalendarizePages', $event->getIndexTypes(), true)) {
            return;
        }

        $categoryIds = $this->getPossibleCategories($event);
        if (empty($categoryIds)) {
            return;
        }

        $rows = $this->getPageUidsByReferencedCategories($categoryIds);

        $indexIds = $event->getIndexIds();
        foreach ($rows as $row) {
            $indexIds[] = (int)$row['uid_foreign'];
        }

        $indexIds[] = -1;
        $event->setIndexIds($indexIds);
    }

    protected function getPossibleCategories(IndexRepositoryDefaultConstraintEvent $event): array
    {
        $table = 'sys_category_record_mm';
        $queryBuilder = HelperUtility::getQueryBuilder($table);
        $additionalSlotArguments = $event->getAdditionalSlotArguments();

        $categoryIds = [];
        if (
            isset($additionalSlotArguments['contentRecord']['uid'])
            && MathUtility::canBeInterpretedAsInteger($additionalSlotArguments['contentRecord']['uid'])
        ) {
            $rows = $queryBuilder
                ->select('uid_local')
                ->from($table)
                ->where(
                    $queryBuilder->expr()->and(
                        $queryBuilder->expr()->eq('tablenames', $queryBuilder->createNamedParameter('tt_content')),
                        $queryBuilder->expr()->eq('fieldname', $queryBuilder->createNamedParameter('categories')),
                        $queryBuilder->expr()->eq(
                            'uid_foreign',
                            $queryBuilder->createNamedParameter($additionalSlotArguments['contentRecord']['uid'])
                        )
                    )
                )
                ->executeQuery()
                ->fetchAllAssociative();

            foreach ($rows as $row) {
                $categoryIds[] = (int)$row['uid_local'];
            }
        }

        if (
            isset($additionalSlotArguments['settings']['pluginConfiguration'])
            && $additionalSlotArguments['settings']['pluginConfiguration'] instanceof PluginConfiguration
        ) {
            /** @var PluginConfiguration $pluginConfiguration */
            $pluginConfiguration = $additionalSlotArguments['settings']['pluginConfiguration'];
            $categories = $pluginConfiguration->getCategories();
            foreach ($categories as $category) {
                $categoryIds[] = $category->getUid();
            }
        }
        return $categoryIds;
    }

    protected function getPageUidsByReferencedCategories(array $categoryIds): array
    {
        $queryBuilder = HelperUtility::getQueryBuilder('pages');
        return $queryBuilder
            ->select('uid_foreign')
            ->from('sys_category_record_mm')
            ->where(
                $queryBuilder->expr()->in('uid_local', $categoryIds),
                $queryBuilder->expr()->eq('tablenames', $queryBuilder->createNamedParameter('pages')),
                $queryBuilder->expr()->eq('fieldname', $queryBuilder->createNamedParameter('categories'))
            )
            ->executeQuery()
            ->fetchAllAssociative();
    }
}
