<?php

namespace App\Domain\Vue\Model\PublicApi\Workout;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class WorkoutGetSingleEquipmentVueModel extends AbstractBaseVueModel
{
    public string $name;
    public string $canonicalName;
}