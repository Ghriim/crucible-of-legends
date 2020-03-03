<?php

namespace App\Domain\Vue\Model\PublicApi\Workout;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class ReferenceWorkoutGetManyVueModel extends AbstractBaseVueModel
{
    /** @var string */
    public $name;

    /** @var string */
    public $canonicalName;

    /** @var string */
    public $createdDate;
}