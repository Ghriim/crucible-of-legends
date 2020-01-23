<?php

namespace App\Domain\Vue\Presenter\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\Workout\ExerciseDTO;
use App\Domain\DataInteractor\DTO\Workout\ReferenceEquipmentDTO;
use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Model\PublicApi\Workout\WorkoutGetSingleEquipmentVueModel;
use App\Domain\Vue\Model\PublicApi\Workout\WorkoutGetSingleExerciseVueModel;
use App\Domain\Vue\Model\PublicApi\Workout\WorkoutGetSingleVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\SingleObjectVuePresenterInterface;

final class WorkoutGetSingleVuePresenter extends AbstractVuePresenter implements SingleObjectVuePresenterInterface
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
        $model->canonicalName = $dto->getCanonicalName();
        $model->exercises = $this->buildExercisesForVueModel($dto->getExercises());

        return $model;
    }

    /**
     * @param ExerciseDTO[] $exercises
     *
     * @return WorkoutGetSingleExerciseVueModel[]
     */
    private function buildExercisesForVueModel(array $exercises): array
    {
        $exercisesForVueModel = [];
        foreach ($exercises as $exercise) {
            $exerciseForVueModel = new WorkoutGetSingleExerciseVueModel();
            $exerciseForVueModel->id = $exercise->getId();
            $exerciseForVueModel->name = $exercise->getReferenceExercise()->getName();
            $exerciseForVueModel->videoLink = $exercise->getReferenceExercise()->getVideoLink();
            $exerciseForVueModel->position = $exercise->getPosition();

            $exerciseForVueModel->details = $this->buildExerciseDetails($exercise);
            $exerciseForVueModel->equipments = $this->buildEquipmentsForVueModel($exercise->getReferenceExercise()->getReferenceEquipments());

            $exercisesForVueModel[] = $exerciseForVueModel;
        }

        return $exercisesForVueModel;
    }

    /**
     * @param ReferenceEquipmentDTO[] $equipments
     *
     * @return WorkoutGetSingleEquipmentVueModel[]
     */
    private function buildEquipmentsForVueModel(array $equipments): array
    {
        $equipmentsForVueModel = [];
        foreach ($equipments as $equipment) {
            $equipmentForVueModel = new WorkoutGetSingleEquipmentVueModel();
            $equipmentForVueModel->id = $equipment->getId();
            $equipmentForVueModel->name = $equipment->getName();

            $equipmentsForVueModel[] = $equipmentForVueModel;
        }

        return $equipmentsForVueModel;
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
            $info['weight'] = ($exercise->getWeightProgrammed() / 1000) . ' kg';
        }

        return $info;
    }
}