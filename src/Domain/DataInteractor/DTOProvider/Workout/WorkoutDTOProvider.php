<?php

namespace App\Domain\DataInteractor\DTOProvider\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractBaseDTOProvider;
use App\Repository\Workout\WorkoutDTORepository;

final class WorkoutDTOProvider extends AbstractBaseDTOProvider
{
    public function __construct(WorkoutDTORepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return WorkoutDTO[]
     */
    public function loadForGetMany(): array
    {
        return $this->repository->findManyByCriteria([], [], ['createdDate' => WorkoutDTORepository::ORDER_DIRECTION_DESC]);
    }

    /**
     * @return AbstractBaseDTO|WorkoutDTO|null
     */
    public function loadForGetOne(string $canonicalName): ?WorkoutDTO
    {
        return $this->repository->findOneByCriteria(['canonicalName' => $canonicalName]);
    }

    /**
     * @return AbstractBaseDTO|WorkoutDTO|null
     */
    public function loadForDelete(string $canonicalName): ?WorkoutDTO
    {
        return $this->repository->findOneByCriteria(['canonicalName' => $canonicalName]);
    }

    /**
     * @return AbstractBaseDTO|WorkoutDTO|null
     */
    public function loadOneWithExercise(string $canonicalName): ?WorkoutDTO
    {
        return $this->repository->findOneByCriteria(['canonicalName' => $canonicalName]);
    }

    /**
     * @return AbstractBaseDTO|WorkoutDTO|null
     */
    public function doesCanonicalNameAlreadyExist(string $canonicalName): bool
    {
        return $this->repository->exists(['canonicalName' => $canonicalName]);
    }
}