<?php

namespace App\Domain\DataInteractor\DTOPersister\Workout;

use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\DataInteractor\DTOPersister\AbstractDTOPersister;

final class WorkoutDTOPersister extends AbstractDTOPersister
{
    public function create(WorkoutDTO $dto): WorkoutDTO
    {
        $this->save($dto);

        return $dto;
    }

    protected function getEntityClassName(): string
    {
        return WorkoutDTO::class;
    }
}