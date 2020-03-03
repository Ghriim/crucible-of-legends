<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\TimeAwareDTOTrait;
use App\Infrastructure\Adapter\DatabaseCollectionAdapter;

class ReferenceWorkoutDTO extends AbstractBaseWorkoutDTO
{
    use TimeAwareDTOTrait;

    /** @var ReferenceWorkoutEmbedReferenceExerciseDTO[]|null */
    private $referenceExercises;

    protected function getDefaultStatus(): string
    {
        return self::STATUS_ACTIVE;
    }

    /**
     * @return ReferenceWorkoutEmbedReferenceExerciseDTO[]|null
     */
    public function getReferenceExercises(): ?array
    {
        return DatabaseCollectionAdapter::getDatabaseCollection($this->referenceExercises);
    }

    /**
     * @param ReferenceWorkoutEmbedReferenceExerciseDTO[]|null $referenceExercises
     */
    public function setReferenceExercises(?array $referenceExercises): void
    {
        $this->referenceExercises = $referenceExercises;
    }
}