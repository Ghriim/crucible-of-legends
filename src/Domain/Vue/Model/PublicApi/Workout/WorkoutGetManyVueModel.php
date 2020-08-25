<?php

namespace App\Domain\Vue\Model\PublicApi\Workout;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class WorkoutGetManyVueModel extends AbstractBaseVueModel
{
    public string $name;
    public string $canonicalName;
    public string $createdDate;
    public string $creatorId;
    public string $creatorName;
}