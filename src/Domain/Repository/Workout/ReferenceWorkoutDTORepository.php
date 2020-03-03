<?php

namespace App\Domain\Repository\Workout;

use App\Domain\DataInteractor\DTO\Workout\ReferenceWorkoutDTO;
use App\Domain\Repository\AbstractBaseRepository;
use App\Infrastructure\Adapter\QueryBuilderAdapter as QueryBuilder;

final class ReferenceWorkoutDTORepository extends AbstractBaseRepository
{
    public function getDTOClassName(): string
    {
        return ReferenceWorkoutDTO::class;
    }

    protected function addCriterionName(QueryBuilder $queryBuilder, $name): bool
    {
        return $this->addCriterion($queryBuilder, 'name', $name);
    }

    protected function addOrderByName(QueryBuilder $queryBuilder, string $direction = self::ORDER_DIRECTION_ASC): void
    {
        $this->addOrderBy($queryBuilder, 'name', $direction);
    }

    protected function addOrderByCreatedDate(QueryBuilder $queryBuilder, string $direction = self::ORDER_DIRECTION_ASC): void
    {

        $this->addOrderBy($queryBuilder, 'createdDate', $direction);
    }

}