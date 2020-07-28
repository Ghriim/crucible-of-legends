<?php

namespace App\Domain\Vue\Model\PublicApi\Workout;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class WorkoutGetSingleExerciseVueModel extends AbstractBaseVueModel
{
    public string $name;
    public string $canonicalName;

    /** @var int|null */
    public ?int $position;

    /** @var string|null */
    public ?string $videoLink;

    /** @var string[] */
    public array $details;

    /** @var WorkoutGetSingleEquipmentVueModel[] */
    public array $equipments;
}