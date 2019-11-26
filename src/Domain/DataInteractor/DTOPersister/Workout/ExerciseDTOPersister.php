<?php

namespace App\Domain\DataInteractor\DTOPersister\Workout;

use App\Domain\DataInteractor\DTO\Workout\ExerciseDTO;
use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\DataInteractor\DTOPersister\AbstractDTOPersister;
use App\Tools\Clock\ClockInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

final class ExerciseDTOPersister extends AbstractDTOPersister
{
    private $workoutDtoPersister;

    public function __construct(
        ManagerRegistry $doctrine,
        ClockInterface $clock,
        WorkoutDTOPersister $workoutDtoPersister
    )
    {
        parent::__construct($doctrine, $clock);

        $this->workoutDtoPersister = $workoutDtoPersister;
    }

    public function addToWorkout(ExerciseDTO $exerciseDTO): ExerciseDTO
    {
        $this->save($exerciseDTO);

        return $exerciseDTO;
    }

    /**
     * @param ExerciseDTO[] $exercises
     */
    public function deleteFromWorkout(ExerciseDTO $exercise): void
    {
        $this->softDelete($exercise, false);

        $this->recomputePositionsAfterDelete($exercise->getWorkout(), $exercise);
        $this->workoutDtoPersister->recomputeEquipments($exercise->getWorkout());

        $this->flush();
    }

    protected function getEntityClassName(): string
    {
        return ExerciseDTO::class;
    }

    private function recomputePositionsAfterDelete(WorkoutDTO $workout, ExerciseDTO $exercise): void
    {
        foreach ($workout->getExercises() as $exerciseFromList) {
            if (ExerciseDTO::STATUS_DELETED !== $exerciseFromList->getStatus()
                && $exerciseFromList->getPosition() > $exercise->getPosition()) {
                $exerciseFromList->setPosition($exerciseFromList->getPosition() - 1);
            }
        }
    }
}