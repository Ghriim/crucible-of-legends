<?php

namespace App\Domain\DataInteractor\DTOProvider\Workout;

use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractDTOProvider;
use App\Repository\Workout\WorkoutDTORepository;

/**
 * @method WorkoutDTORepository getRepository()
 */
final class WorkoutDTOProvider extends AbstractDTOProvider
{
    /**
     * @return WorkoutDTO[]
     */
    public function loadForGetMany(): array
    {
        return $this->getRepository()->findManyByCriteria([], [], ['createdDate' => self::ORDER_DIRECTION_DESC]);
    }

    public function loadForGetOne(string $canonicalName): ?WorkoutDTO
    {
        return $this->getRepository()->findOneByCriteria(['canonicalName' => $canonicalName], ['exercises']);
    }

    public function loadForDelete(string $canonicalName): ?WorkoutDTO
    {
        return $this->getRepository()->findOneByCriteria(['canonicalName' => $canonicalName], ['exercises']);
    }

    public function loadOneWithExercise(string $canonicalName): ?WorkoutDTO
    {
        return $this->getRepository()->findOneByCriteria(['canonicalName' => $canonicalName], ['exercises']);
    }

    public function doesCanonicalNameAlreadyExist(string $canonicalName): bool
    {
        return $this->getRepository()->exists(['canonicalName' => $canonicalName]);
    }

    protected function getEntityClassName(): string
    {
        return WorkoutDTO::class;
    }
}