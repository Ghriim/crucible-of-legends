<?php

namespace App\Domain\Vue\Presenter\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\Workout\AbstractReferenceExerciseDTO;
use App\Domain\Vue\Model\PublicApi\Workout\ReferenceExerciseGetManyVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\MultipleObjectVuePresenterInterface;

final class ReferenceExerciseGetManyVuePresenter extends AbstractVuePresenter implements MultipleObjectVuePresenterInterface
{
    /**
     * @param AbstractReferenceExerciseDTO[] $dtos
     *
     * @return ReferenceExerciseGetManyVueModel[]
     */
    public function buildMultipleObjectVueModel(array $dtos): array
    {
        $models = [];
        foreach ($dtos as $dto) {
            $model = new ReferenceExerciseGetManyVueModel();
            $model->id = $dto->getId();
            $model->name = $dto->getName();

            $models[] = $model;
        }

        return $models;
    }
}