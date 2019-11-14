<?php

namespace App\Domain\Vue\Presenter\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Model\PublicApi\Workout\WorkoutPostVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\SingleObjectVueModelInterface;

final class WorkoutPostVuePresenter extends AbstractVuePresenter implements SingleObjectVueModelInterface
{
    /**
     * @param WorkoutDTO $dto
     *
     * @return WorkoutPostVueModel
     */
    public function buildSingleObjectVueModel(AbstractBaseDTO $dto): AbstractBaseVueModel
    {
        $model = new WorkoutPostVueModel();
        $model->id = $dto->getId();
        $model->name = $dto->getName();

        return $model;
    }
}