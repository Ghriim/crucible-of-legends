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
        $this->addSelectReferenceExercise($queryBuilder);

        return $this->addCriterion($queryBuilder, 'reference_exercise', 'name', $name);
    }

    protected function addOrderByPosition(QueryBuilder $queryBuilder, string $direction = self::ORDER_DIRECTION_ASC): void
    {
        $queryBuilder->addOrderBy($this->getAlias() . '.position', $direction);
    }

    protected function addSelectReferenceExercise(QueryBuilder $queryBuilder): void
    {
        $queryBuilder->leftJoin($this->getAlias() . '.referenceExercise', 'reference_exercise')
                     ->addSelect('reference_exercise');
    }

    public function getAlias(): string
    {
        return 'exercise';
    }
}