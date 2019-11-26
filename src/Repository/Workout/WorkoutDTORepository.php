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

    /**
     * @param string|string[]|null $canonicalName
     */
    protected function addCriterionCanonicalName(QueryBuilder $queryBuilder, $canonicalName): bool
    {
        return $this->addCriterion($queryBuilder, $this->getAlias(), 'canonicalName', $canonicalName);
    }

    protected function addSelectExercises(QueryBuilder $queryBuilder): void
    {
        $this->addSelect($queryBuilder, $this->getAlias(), 'exercises', 'workout_exercise');
        $this->addSelect($queryBuilder, 'workout_exercise', 'referenceExercise', 'reference_exercise');
        $this->addSelect($queryBuilder, 'reference_exercise', 'referenceEquipments', 'workout_exercise_equipment');

        $queryBuilder->addOrderBy('workout_exercise.position');
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