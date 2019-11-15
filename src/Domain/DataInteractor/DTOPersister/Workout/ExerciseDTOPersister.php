<?php

namespace App\Domain\DataInteractor\DTOPersister\Workout;

use App\Domain\DataInteractor\DTO\Workout\ExerciseDTO;
use App\Domain\DataInteractor\DTOPersister\AbstractDTOPersister;

final class ExerciseDTOPersister extends AbstractDTOPersister
{
    /**
     * @param ExerciseDTO[] $exercises
     */
    public function deleteFromList(ExerciseDTO $exercise, array $exercises): void
    {
        foreach ($exercises as $exerciseFromList) {
            if (ExerciseDTO::STATUS_DELETED !== $exerciseFromList->getStatus()
                && $exerciseFromList->getPosition() > $exercise->getPosition()) {
                $exerciseFromList->setPosition($exerciseFromList->getPosition() - 1);
            }
        }

        $this->softDelete($exercise);
    }

    /**
     * @param ExerciseDTO[] $exercises
     *
     * @return ExerciseDTO
     */
    public function recomputeExercisesPosition(array $exercises): array
    {

    }

    protected function getEntityClassName(): string
    {
        return ExerciseDTO::class;
    }
}