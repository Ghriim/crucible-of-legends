<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use Doctrine\ODM\MongoDB\PersistentCollection;
use MongoDB\Collection;

class ReferenceWorkoutDTO extends AbstractBaseWorkoutDTO
{
    /** @var PersistentCollection|AbstractReferenceExerciseDTO[] */
    private $referenceExercises;

    protected function getDefaultStatus(): string
    {
        return self::STATUS_ACTIVE;
    }

    public function getReferenceExercises(): array
    {
        if ($this->referenceExercises instanceof Collection) {
            $this->lazyLoadProtect($this->referenceExercises);

            return $this->referenceExercises->toArray();
        }

        return $this->referenceExercises;
    }

    public function setReferenceExercises(array $referenceExercises): void
    {
        $this->referenceExercises = $referenceExercises;
    }
}