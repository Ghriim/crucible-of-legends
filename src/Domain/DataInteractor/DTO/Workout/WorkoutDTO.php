<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\TimeAwareDTOTrait;
use App\Infrastructure\Adapter\DatabaseCollectionAdapter;

class WorkoutDTO extends AbstractBaseDTO
{
    use TimeAwareDTOTrait;

    private string $name;

    private string $canonicalName;

    /**
     * @var ExerciseDTO[]
     */
    private $exercises = [];

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

    public function getExercises(): array
    {
        return DatabaseCollectionAdapter::getDatabaseCollection($this->exercises);
    }

    /**
     * @param ExerciseDTO[] $exercises
     */
    public function setExercises(array $exercises): void
    {
        $this->exercises = $exercises;
    }
}