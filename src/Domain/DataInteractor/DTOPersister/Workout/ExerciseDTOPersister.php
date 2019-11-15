<?php

namespace App\Domain\DataInteractor\DTOPersister\Workout;

use App\Domain\DataInteractor\DTO\Workout\ExerciseDTO;
use App\Domain\DataInteractor\DTOPersister\AbstractDTOPersister;

final class ExerciseDTOPersister extends AbstractDTOPersister
{
    public function addToWorkout(ExerciseDTO $exerciseDTO): ExerciseDTO
    {
        $this->save($exerciseDTO);

        return $exerciseDTO;
    }

    /**
     * @param ExerciseDTO[] $exercises
     */
    public function deleteFromList(ExerciseDTO $exercise, array $exercises): void
    {
        $this->softDelete($exercise, false);

        foreach ($exercises as $exerciseFromList) {
            if (ExerciseDTO::STATUS_DELETED !== $exerciseFromList->getStatus()
                && $exerciseFromList->getPosition() > $exercise->getPosition()) {
                $exerciseFromList->setPosition($exerciseFromList->getPosition() - 1);
            }
        }

        $this->flush();
    }

    protected function getEntityClassName(): string
    {
        return ExerciseDTO::class;
    }
}