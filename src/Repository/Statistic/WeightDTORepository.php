<?php

namespace App\Repository\Statistic;

use App\Repository\AbstractBaseEntityRepository;
use Doctrine\ORM\QueryBuilder;

final class WeightDTORepository extends AbstractBaseEntityRepository
{
    /**
     * @param int|int[]|null $userId
     */
    public function addCriterionUser(QueryBuilder $queryBuilder, $userId): bool
    {
        return $this->addCriterion($queryBuilder, $this->getAlias(), 'user', $userId);
    }

    public function addOrderByCreatedDate(QueryBuilder $queryBuilder, string $direction = self::ORDER_DIRECTION_ASC): void
    {
        $this->addOrderBy($queryBuilder, $this->getAlias(), 'createdDate', $direction);
    }

    public function getAlias(): string
    {
        return 'weight';
    }
}