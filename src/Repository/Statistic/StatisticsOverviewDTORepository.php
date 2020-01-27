<?php

namespace App\Repository\Statistic;

use App\Repository\AbstractBaseEntityRepository;
use Doctrine\ORM\QueryBuilder;

final class StatisticsOverviewDTORepository extends AbstractBaseEntityRepository
{
    /**
     * @param QueryBuilder   $queryBuilder
     * @param int|int[]|null $id
     *
     * @return bool
     */
    public function addCriterionUser(QueryBuilder $queryBuilder, $id): bool
    {
        return $this->addCriterion($queryBuilder, $this->getAlias(), 'user', $id);
    }

    public function getAlias(): string
    {
        return 'statistics_overview';
    }
}