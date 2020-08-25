<?php

namespace App\Domain\Vue\Presenter\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\Vue\Model\PublicApi\Workout\WorkoutGetManyVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\MultipleObjectVuePresenterInterface;

final class WorkoutGetManyVuePresenter extends AbstractVuePresenter implements MultipleObjectVuePresenterInterface
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
            $model->canonicalName = $dto->getCanonicalName();
            $model->createdDate = $this->dateTimeString($dto->getCreatedDate());
            $model->creatorId = $dto->getCreatedByUser()->getId();
            $model->creatorName = $dto->getCreatedByUser()->getUsername();
            $models[] = $model;
        }

        return $models;
    }
}