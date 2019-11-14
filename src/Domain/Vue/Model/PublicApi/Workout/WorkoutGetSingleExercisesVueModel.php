<?php

namespace App\Domain\Vue\Model\PublicApi\Workout;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class WorkoutGetSingleExercisesVueModel extends AbstractBaseVueModel
{
    /** @var string */
    public $name;

    /** @var int|null */
    public $position;

    /** @var string[] */
    public $details;
}