<?php

namespace App\Repository\Workout;

use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\Repository\AbstractBaseRepository;
use App\Infrastructure\Adapter\QueryBuilderAdapter as QueryBuilder;

final class WorkoutDTORepository extends AbstractBaseRepository
{
    protected function getDTOClassName(): string
    {
        return WorkoutDTO::class;
    }

    /**
     * @param string|string[]|null $name
     */
    protected function addCriterionName(QueryBuilder $queryBuilder, $name): bool
    {
        return $this->addCriterion($queryBuilder, 'name', $name);
    }

    /**
     * @param string|string[]|null $canonicalName
     */
    protected function addCriterionCanonicalName(QueryBuilder $queryBuilder, $canonicalName): bool
    {
        return $this->addCriterion($queryBuilder, 'canonicalName', $canonicalName);
    }

    protected function addOrderByCreatedDate(QueryBuilder $queryBuilder, string $direction = self::ORDER_DIRECTION_ASC): void
    {
        $queryBuilder->addOrderBy('createdDate', $direction);
    }
}