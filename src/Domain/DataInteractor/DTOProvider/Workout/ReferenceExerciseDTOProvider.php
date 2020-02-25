<?php

namespace App\Domain\DataInteractor\DTOProvider\Workout;

use App\Domain\DataInteractor\DTO\Workout\AbstractReferenceExerciseDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractDTOProvider;
use App\Repository\Workout\ReferenceExerciseDTORepository;

/**
 * @method ReferenceExerciseDTORepository getRepository()
 * @method AbstractReferenceExerciseDTO loadOneById($id)
 */
final class ReferenceExerciseDTOProvider extends AbstractDTOProvider
{
    /**
     * @return AbstractReferenceExerciseDTO[]
     */
    public function loadForGetMany(array $criteria): array
    {
        return $this->getRepository()->findManyByCriteria($criteria, [], ['name' => self::ORDER_DIRECTION_ASC]);
    }

    protected function getEntityClassName(): string
    {
        return AbstractReferenceExerciseDTO::class;
    }
}