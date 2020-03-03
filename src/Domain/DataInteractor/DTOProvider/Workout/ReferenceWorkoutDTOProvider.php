<?php

namespace App\Domain\DataInteractor\DTOProvider\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\Workout\ReferenceWorkoutDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractBaseDTOProvider;
use App\Domain\Repository\Workout\ReferenceWorkoutDTORepository;

final class ReferenceWorkoutDTOProvider extends AbstractBaseDTOProvider
{
    public function __construct(ReferenceWorkoutDTORepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return AbstractBaseDTO[]|ReferenceWorkoutDTO[]
     */
    public function loadForGetMany(): array
    {
        return $this->getManyByCriteria([], [], ['createdDate' => ReferenceWorkoutDTORepository::ORDER_DIRECTION_DESC]);
    }

    /**
     * @return AbstractBaseDTO|ReferenceWorkoutDTO|null
     */
    public function loadForGetOne(string $canonicalName): ?ReferenceWorkoutDTO
    {
        return $this->getOneByCriteria(['canonicalName' => $canonicalName], ['referenceExercises']);
    }
}