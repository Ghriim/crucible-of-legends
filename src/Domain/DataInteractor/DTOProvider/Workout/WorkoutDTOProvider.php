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

    public function loadForGetOne(string $name): ?WorkoutDTO
    {
        return $this->getRepository()->findOneByCriteria(['name' => $name], ['exercises']);
    }

    protected function getEntityClassName(): string
    {
        return WorkoutDTO::class;
    }
}