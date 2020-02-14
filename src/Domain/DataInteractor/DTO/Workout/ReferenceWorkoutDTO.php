<?php

namespace App\Domain\DataInteractor\DTO\Workout;

class ReferenceWorkoutDTO extends AbstractBaseWorkoutDTO
{
    protected function getDefaultStatus(): string
    {
        return self::STATUS_ACTIVE;
    }
}