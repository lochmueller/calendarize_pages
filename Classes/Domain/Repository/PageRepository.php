<?php

namespace HDNET\CalendarizePages\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Qom\OrInterface;

/**
 * Repository for Page models.
 */
class PageRepository extends Repository
{
    /**
     * Get the IDs of the given search term.
     */
    public function findBySearch(string $searchTerm, array $categories): array
    {
        $query = $this->createQuery();
        $constraints = [];

        $constraints[] = $query->equals('doktype', 132);

        if ($searchTerm !== '') {
            $constraints['searchTerm'] = $this->getConstraintForSearchWord($query, $searchTerm);
        }
        if (count($categories)) {
            $categoriesIds = [];
            foreach ($categories as $category) {
                $categoriesIds[] = $query->contains('categories', $category);
            }
            $constraints['categories'] = $query->logicalOr(...$categoriesIds);
        }

        $query->matching($query->logicalAnd(...$constraints));
        $rows = $query->execute(true);

        $ids = [];
        foreach ($rows as $row) {
            $ids[] = (int) $row['uid'];
        }

        return $ids;
    }

    protected function getConstraintForSearchWord(QueryInterface $query, string $searchWord): OrInterface
    {
        $logicalOrConstraints = [
            $query->like('title', '%' . $searchWord . '%'),
            $query->like('abstract', '%' . $searchWord . '%'),
            $query->like('description', '%' . $searchWord . '%'),
        ];

        return $query->logicalOr(...$logicalOrConstraints);
    }
}
