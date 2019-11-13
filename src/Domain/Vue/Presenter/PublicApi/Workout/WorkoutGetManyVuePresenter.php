<?php

namespace App\Domain\Vue\Presenter\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\Vue\Model\PublicApi\Workout\WorkoutGetManyVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;

final class WorkoutGetManyVuePresenter extends AbstractVuePresenter
{
    /**
     * @param WorkoutDTO[] $dtos
     *
     * @return WorkoutGetManyVueModel[]
     */
    public function buildMultipleObjectVueModel(array $dtos): array
    {
        $models = [];
        foreach ($dtos as $dto) {
            $model = new WorkoutGetManyVueModel();
            $model->id = $dto->getId();
            $model->name = $dto->getName();
            $model->createdDate = $this->dateTimeToString($dto->getCreatedDate());

            $models[] = $model;
        }

        return $models;
    }
}