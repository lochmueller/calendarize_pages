<?php

namespace HDNET\CalendarizePages\EventListener;

use HDNET\Calendarize\Domain\Model\PluginConfiguration;
use HDNET\Calendarize\Event\IndexRepositoryDefaultConstraintEvent;
use HDNET\Calendarize\Utility\HelperUtility;
use HDNET\CalendarizePages\EventRegister;
use TYPO3\CMS\Core\Utility\MathUtility;

class PagesEventConstraintsListener
{
    public function __invoke(IndexRepositoryDefaultConstraintEvent $event)
    {
        if (!empty($event->getIndexTypes()) && !\in_array(EventRegister::REGISTER_KEY, $event->getIndexTypes(), true)) {
            return;
        }

        $categoryIds = $this->getPossibleCategories($event);


        if (empty($categoryIds)) {
            return;
        }

        $db = HelperUtility::getDatabaseConnection('pages');
        $q = $db->createQueryBuilder();
        $q->resetQueryParts();
        $rows = $q->select('uid_foreign')
            ->from('sys_category_record_mm')
            ->where(
                $q->expr()->in('uid_local', $categoryIds),
                $q->expr()->eq('tablenames', $q->quote('pages')),
                $q->expr()->eq('fieldname', $q->quote('categories'))
            )
            ->execute()
            ->fetchAll();

        $indexIds = $event->getIndexIds();
        foreach ($rows as $row) {
            $indexIds[] = (int)$row['uid_foreign'];
        }

        $indexIds[] = -1;
        $event->setIndexIds($indexIds);
    }

    protected function getPossibleCategories(IndexRepositoryDefaultConstraintEvent $event):array {

        $table = 'sys_category_record_mm';
        $db = HelperUtility::getDatabaseConnection($table);
        $q = $db->createQueryBuilder();
        $additionalSlotArguments = $event->getAdditionalSlotArguments();

        $categoryIds = [];
        if (isset($additionalSlotArguments['contentRecord']['uid']) && MathUtility::canBeInterpretedAsInteger($additionalSlotArguments['contentRecord']['uid'])) {
            $rows = $q->select('uid_local')
                ->from($table)
                ->where(
                    $q->expr()->andX(
                        $q->expr()->eq('tablenames', $q->quote('tt_content')),
                        $q->expr()->eq('fieldname', $q->quote('categories')),
                        $q->expr()->eq('uid_foreign', $q->createNamedParameter($additionalSlotArguments['contentRecord']['uid']))
                    )
                )
                ->execute()
                ->fetchAll();

            foreach ($rows as $row) {
                $categoryIds[] = (int)$row['uid_local'];
            }
        }

        if (isset($additionalSlotArguments['settings']['pluginConfiguration']) && $additionalSlotArguments['settings']['pluginConfiguration'] instanceof PluginConfiguration) {
            /** @var PluginConfiguration $pluginConfiguration */
            $pluginConfiguration = $additionalSlotArguments['settings']['pluginConfiguration'];
            $categories = $pluginConfiguration->getCategories();
            foreach ($categories as $category) {
                $categoryIds[] = $category->getUid();
            }
        }
        return $categoryIds;
    }
}
