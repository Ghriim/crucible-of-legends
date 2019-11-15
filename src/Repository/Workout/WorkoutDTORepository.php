<?php

namespace App\Repository\Workout;

use App\Domain\DataInteractor\DTO\Workout\ExerciseDTO;
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
        $queryBuilder->leftJoin($this->getAlias() . '.exercises', 'workout_exercise')
                     ->addSelect('workout_exercise')
                     ->andWhere('workout_exercise.status != :exercise_status_deleted')
                     ->setParameter('exercise_status_deleted', ExerciseDTO::STATUS_DELETED)
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