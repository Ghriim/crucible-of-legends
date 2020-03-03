<?php

namespace App\Domain\Vue\Presenter\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\Workout\ReferenceWorkoutDTO;
use App\Domain\Vue\Model\PublicApi\Workout\ReferenceWorkoutGetManyVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\MultipleObjectVuePresenterInterface;

final class ReferenceWorkoutGetManyVuePresenter extends AbstractVuePresenter implements MultipleObjectVuePresenterInterface
{
    /**
     * @param ReferenceWorkoutDTO[] $dtos
     *
     * @return ReferenceWorkoutGetManyVueModel[]
     */
    public function buildMultipleObjectVueModel(array $dtos): array
    {
        $models = [];
        foreach ($dtos as $dto) {
            $model = new ReferenceWorkoutGetManyVueModel();
            $model->name = $dto->getName();
            $model->canonicalName = $dto->getCanonicalName();
            $model->createdDate = $this->dateTimeString($dto->getCreatedDate());

            $models[] = $model;
        }

        return $models;
    }
}
