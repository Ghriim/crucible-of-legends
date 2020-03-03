<?php

namespace App\Domain\Vue\Presenter\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\Workout\ReferenceExerciseDTO;
use App\Domain\DataInteractor\DTO\Workout\ReferenceWorkoutDTO;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Model\PublicApi\Workout\ReferenceWorkoutGetSingleVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\SingleObjectVuePresenterInterface;

final class ReferenceWorkoutGetSingleVuePresenter extends AbstractVuePresenter implements SingleObjectVuePresenterInterface
{
    /**
     * @param ReferenceWorkoutDTO $dto
     *
     * @return ReferenceWorkoutGetSingleVueModel
     */
    public function buildSingleObjectVueModel(AbstractBaseDTO $dto): AbstractBaseVueModel
    {
        $model = new ReferenceWorkoutGetSingleVueModel();
        $model->name = $dto->getName();
        $model->canonicalName = $dto->getCanonicalName();
        $model->createdDate = $this->dateTimeString($dto->getCreatedDate());
        $model->exercises = $this->buildExercisesForVueModel($dto->getReferenceExercises());


        return $model;
    }

    /**
     * @param ReferenceExerciseDTO[] $exercises
     *
     * @return array
     */
    private function buildExercisesForVueModel(array $exercises): array
    {
        $orderedExercises = [];
        foreach ($exercises as $exercise) {

        }

        return $orderedExercises;
    }
}