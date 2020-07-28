<?php

namespace App\Domain\Vue\Model\PublicApi\Workout;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class WorkoutGetSingleVueModel extends AbstractBaseVueModel
{
    public string $name;
    public string $canonicalName;

    /** @var WorkoutGetSingleExerciseVueModel[] */
    public array $exercises;
}