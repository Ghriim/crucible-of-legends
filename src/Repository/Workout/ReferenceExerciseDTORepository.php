<?php

namespace App\Repository\Workout;

use App\Repository\AbstractBaseEntityRepository;
use Doctrine\ORM\QueryBuilder;

final class ReferenceExerciseDTORepository extends AbstractBaseEntityRepository
{
    /**
     * @param string|string[]|null $name
     */
    protected function addCriterionName(QueryBuilder $queryBuilder, $name): bool
    {
        return $this->addCriterion($queryBuilder, $this->getAlias(), 'name', $name);
    }

    protected function addOrderByName(QueryBuilder $queryBuilder, string $direction = self::ORDER_DIRECTION_ASC): void
    {
        $queryBuilder->addOrderBy($this->getAlias() . '.name', $direction);
    }

    public function getAlias(): string
    {
        return 'exercise';
    }
}