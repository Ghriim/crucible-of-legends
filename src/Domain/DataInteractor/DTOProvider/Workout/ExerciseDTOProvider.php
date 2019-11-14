<?php

namespace App\Domain\DataInteractor\DTOProvider\Workout;

use App\Domain\DataInteractor\DTO\Workout\ExerciseDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractDTOProvider;
use App\Repository\Workout\ExerciseDTORepository;

/**
 * @method ExerciseDTORepository getRepository()
 */
final class ExerciseDTOProvider extends AbstractDTOProvider
{
    protected function getEntityClassName(): string
    {
        return ExerciseDTO::class;
    }
}