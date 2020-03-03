<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\TimeAwareDTOTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;

class WorkoutDTO extends AbstractBaseWorkoutDTO
{
    use TimeAwareDTOTrait;

    /** @var PersistentCollection|ExerciseDTO[] */
    private $exercises;

    protected function getDefaultStatus(): string
    {
        return self::STATUS_ACTIVE;
    }

    /**
     * @return ExerciseDTO[]
     */
    public function getExercises(): array
    {
        if ($this->exercises instanceof Collection) {
            $this->lazyLoadProtect($this->exercises);

            return $this->exercises->toArray();
        }

        return $this->exercises;
    }

    /**
     * @param ExerciseDTO[] $exercises
     */
    public function setExercises(array $exercises): void
    {
        $this->exercises = $exercises;
    }

    public function getHighestPosition(): int
    {
        $highestPosition = 0;
        foreach ($this->getExercises() as $exercise) {
            if ($exercise->getPosition() > $highestPosition) {
                $highestPosition = $exercise->getPosition();
            }
        }

        return $highestPosition;
    }
}