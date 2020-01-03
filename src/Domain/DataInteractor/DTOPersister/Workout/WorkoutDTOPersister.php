<?php

namespace App\Domain\DataInteractor\DTOPersister\Workout;

use App\Domain\DataInteractor\DTO\Workout\ExerciseDTO;
use App\Domain\DataInteractor\DTO\Workout\ReferenceEquipmentDTO;
use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\DataInteractor\DTOPersister\AbstractDTOPersister;

final class WorkoutDTOPersister extends AbstractDTOPersister
{
    public function create(WorkoutDTO $dto): WorkoutDTO
    {
        $this->save($dto);

        return $dto;
    }

    public function delete(WorkoutDTO $dto): void
    {
        $this->softDelete($dto);
    }

    public function recomputeEquipments(WorkoutDTO $workout): void
    {
        $equipments = [];
        foreach ($workout->getExercises() as $exerciseFromList) {
            if (ExerciseDTO::STATUS_DELETED !== $exerciseFromList->getStatus()) {
                foreach ($exerciseFromList->getReferenceExercise()->getReferenceEquipments() as $equipmentFromList) {
                    if (ReferenceEquipmentDTO::STATUS_DELETED !== $equipmentFromList->getStatus()) {
                        $equipments[$equipmentFromList->getId()] = $equipmentFromList;
                    }
                }
            }
        }
    }

    protected function getEntityClassName(): string
    {
        return WorkoutDTO::class;
    }
}