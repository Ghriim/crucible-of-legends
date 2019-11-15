<?php

namespace App\Domain\DataInteractor\DTOProvider\Workout;

use App\Domain\DataInteractor\DTO\Workout\ReferenceExerciseDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractDTOProvider;
use App\Repository\Workout\ReferenceExerciseDTORepository;

/**
 * @method ReferenceExerciseDTORepository getRepository()
 * @method ReferenceExerciseDTO loadOneById($id)
 */
final class ReferenceExerciseDTOProvider extends AbstractDTOProvider
{
    /**
     * @return ReferenceExerciseDTO[]
     */
    public function loadForGetMany(array $criteria): array
    {
        return $this->getRepository()->findManyByCriteria($criteria, [], ['name' => self::ORDER_DIRECTION_ASC]);
    }

    protected function getEntityClassName(): string
    {
        return ReferenceExerciseDTO::class;
    }
}