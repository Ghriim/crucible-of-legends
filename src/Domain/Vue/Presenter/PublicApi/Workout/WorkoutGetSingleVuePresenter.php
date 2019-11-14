<?php

namespace App\Domain\Vue\Presenter\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\Workout\ExerciseDTO;
use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Model\PublicApi\Workout\WorkoutGetSingleExercisesVueModel;
use App\Domain\Vue\Model\PublicApi\Workout\WorkoutGetSingleVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\SingleObjectVueModelInterface;

final class WorkoutGetSingleVuePresenter extends AbstractVuePresenter implements SingleObjectVueModelInterface
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
        $model->exercises = $this->buildExercisesForVueModel($dto->getExercises());

        return $model;
    }

    /**
     * @param ExerciseDTO[] $exercises
     *
     * @return WorkoutGetSingleExercisesVueModel[]
     */
    private function buildExercisesForVueModel(array $exercises): array
    {
        $exercisesForVueModel = [];
        foreach ($exercises as $exercise) {
            $exerciseForVueModel = new WorkoutGetSingleExercisesVueModel();
            $exerciseForVueModel->id = $exercise->getId();
            $exerciseForVueModel->name = $exercise->getName();
            $exerciseForVueModel->position = $exercise->getPosition();

            $exerciseForVueModel->details = $this->buildExerciseDetails($exercise);

            $exercisesForVueModel[] = $exerciseForVueModel;
        }

        return $exercisesForVueModel;
    }

    private function buildExerciseDetails(ExerciseDTO $exercise): array
    {
        $info = [];
        if (null !== $exercise->getDurationProgrammed()) {
            $info['duration'] = $exercise->getDurationProgrammed() . 'sec';
        }

        if (null !== $exercise->getRepetitionsProgrammed()) {
            $info['repetitions'] = $exercise->getRepetitionsProgrammed() . 'reps';
        }

        if (null !== $exercise->getWeightProgrammed()) {
            $info['weight'] = $exercise->getWeightProgrammed() . ' kg';
        }

        return $info;
    }
}