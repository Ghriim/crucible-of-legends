<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;

final class WorkoutDTO extends AbstractBaseDTO
{
    /** @var string */
    private $name;

    /** @var string */
    private $canonicalName;

    /** @var PersistentCollection|ExerciseDTO[] */
    private $exercises;

    /** @var PersistentCollection|ReferenceEquipmentDTO[] */
    private $equipments;

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

    public function getCanonicalName(): string
    {
        return $this->canonicalName;
    }

    public function setCanonicalName(string $canonicalName): void
    {
        $this->canonicalName = $canonicalName;
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

    /**
     * @return ReferenceEquipmentDTO[]
     */
    public function getEquipments(): array
    {
        if ($this->equipments instanceof Collection) {
            $this->lazyLoadProtect($this->equipments);

            return $this->equipments->toArray();
        }

        return $this->equipments;
    }

    /**
     * @param ReferenceEquipmentDTO[] $equipments
     */
    public function setEquipments(array $equipments): void
    {
        $this->equipments = $equipments;
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