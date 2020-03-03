<?php

namespace App\Domain\DataInteractor\DTOProvider\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractBaseDTOProvider;
use App\Domain\Repository\Workout\ReferenceWorkoutDTORepository;

final class ReferenceWorkoutDTOProvider extends AbstractBaseDTOProvider
{
    public function __construct(ReferenceWorkoutDTORepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return AbstractBaseDTO[]|WorkoutDTO[]
     */
    public function loadForGetMany(): array
    {
        return $this->getManyByCriteria([], [], ['createdDate' => ReferenceWorkoutDTORepository::ORDER_DIRECTION_DESC]);
    }

    /**
     * @return AbstractBaseDTO|WorkoutDTO|null
     */
    public function loadForGetOne(string $canonicalName): ?WorkoutDTO
    {
        return $this->getOneByCriteria(['canonicalName' => $canonicalName], ['exercises']);
    }

    /**
     * @return AbstractBaseDTO|WorkoutDTO|null
     */
    public function loadForDelete(string $canonicalName): ?WorkoutDTO
    {
        return $this->getOneByCriteria(['canonicalName' => $canonicalName], ['exercises']);
    }

    /**
     * @return AbstractBaseDTO|WorkoutDTO|null
     */
    public function loadOneWithExercise(string $canonicalName): ?WorkoutDTO
    {
        return $this->getOneByCriteria(['canonicalName' => $canonicalName], ['exercises']);
    }

    public function doesCanonicalNameAlreadyExist(string $canonicalName): bool
    {
        return $this->exists(['canonicalName' => $canonicalName]);
    }
}