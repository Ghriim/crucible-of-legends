<?php

namespace App\Repository\Workout;

use App\Repository\AbstractBaseEntityRepository;
use Doctrine\ORM\QueryBuilder;

final class WorkoutDTORepository extends AbstractBaseEntityRepository
{
    /**
     * @param string|string[]|null $name
     */
    protected function addCriterionName(QueryBuilder $queryBuilder, $name): bool
    {
        return $this->addCriterion($queryBuilder, $this->getAlias(), 'name', $name);
    }


    protected function addSelectExercises(QueryBuilder $queryBuilder): void
    {
        $queryBuilder->leftJoin($this->getAlias() . '.exercises', 'workout_exercise')
                     ->addSelect('workout_exercise')
                     ->addOrderBy('workout_exercise.position');
    }

    protected function addOrderByCreatedDate(QueryBuilder $queryBuilder, string $direction = self::ORDER_DIRECTION_ASC): void
    {
        $queryBuilder->addOrderBy($this->getAlias() . '.createdDate', $direction);
    }

    public function getAlias(): string
    {
        return 'workout';
    }
}