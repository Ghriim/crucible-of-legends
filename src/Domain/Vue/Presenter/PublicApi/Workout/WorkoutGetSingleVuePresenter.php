<?php

namespace App\Domain\Vue\Presenter\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Model\PublicApi\Workout\WorkoutGetSingleVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;

final class WorkoutGetSingleVuePresenter extends AbstractVuePresenter
{
    /**
     * @param WorkoutDTO $dto
     *
     * @return WorkoutGetSingleVueModel
     */
    public function buildSingleObjectVueModel(AbstractBaseDTO $dto): AbstractBaseVueModel
    {
        $model = new WorkoutGetSingleVueModel();
        $model->id = $dto->getId();
        $model->name = $dto->getName();

        return $model;
    }
}