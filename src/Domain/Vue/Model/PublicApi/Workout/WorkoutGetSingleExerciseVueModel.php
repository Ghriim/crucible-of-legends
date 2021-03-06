<?php

namespace App\Domain\Vue\Model\PublicApi\Workout;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class WorkoutGetSingleExerciseVueModel extends AbstractBaseVueModel
{
    /** @var string */
    public $name;

    /** @var int|null */
    public $position;

    /** @var string|null */
    public $videoLink;

    /** @var string[] */
    public $details;

    /** @var WorkoutGetSingleEquipmentVueModel[] */
    public $equipments;
}