<?php

namespace App\Repository\Workout;

use App\Repository\AbstractBaseEntityRepository;
use Doctrine\ORM\QueryBuilder;

final class ExerciseDTORepository extends AbstractBaseEntityRepository
{
    /**
     * @param string|string[]|null $name
     */
    protected function addCriterionName(QueryBuilder $queryBuilder, $name): bool
    {
        return $this->addCriterion($queryBuilder, $this->getAlias(), 'name', $name);
    }

    protected function addOrderByPosition(QueryBuilder $queryBuilder, string $direction = self::ORDER_DIRECTION_ASC): void
    {
        $queryBuilder->addOrderBy($this->getAlias() . '.position', $direction);
    }

    public function getAlias(): string
    {
        return 'exercise';
    }
}