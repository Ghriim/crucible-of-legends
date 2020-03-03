<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\TimeAwareDTOTrait;
use App\Infrastructure\Adapter\DatabaseCollectionAdapter;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;

class ReferenceExerciseDTO extends AbstractReferenceExerciseDTO
{
    use TimeAwareDTOTrait;
}