<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;

final class WorkoutDTO extends AbstractBaseDTO
{
    /** @var string */
    private $name;

    /** @var PersistentCollection|ExerciseDTO[] */
    private $exercises;

    protected function getDefaultStatus(): string
    {
        return self::STATUS_ACTIVE;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getExercises(): array
    {
        if ($this->exercises instanceof Collection) {
            $this->lazyLoadProtect($this->exercises);

            return $this->exercises->toArray();
        }

        return $this->exercises;
    }

    public function setExercises(array $exercises): void
    {
        $this->exercises = $exercises;
    }
}