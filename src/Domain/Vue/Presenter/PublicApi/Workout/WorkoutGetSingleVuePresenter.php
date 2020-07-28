<?php

namespace App\Domain\Vue\Presenter\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\Workout\EquipmentDTO;
use App\Domain\DataInteractor\DTO\Workout\ExerciseDTO;
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
            $exerciseForVueModel->name = $exercise->getName();
            $exerciseForVueModel->canonicalName = $exercise->getCanonicalName();
            $exerciseForVueModel->videoLink = $exercise->getCanonicalName();
            $exerciseForVueModel->equipments = $this->buildEquipmentsForVueModel($exercise->getEquipments());

            $exercisesForVueModel[] = $exerciseForVueModel;
        }

        return $exercisesForVueModel;
    }

    /**
     * @param EquipmentDTO[] $equipments
     *
     * @return WorkoutGetSingleEquipmentVueModel[]
     */
    private function buildEquipmentsForVueModel(array $equipments): array
    {
        $equipmentsForVueModel = [];
        foreach ($equipments as $equipment) {
            $equipmentForVueModel = new WorkoutGetSingleEquipmentVueModel();
            $equipmentForVueModel->name = $equipment->getName();
            $equipmentForVueModel->canonicalName = $equipment->getCanonicalName();

            $equipmentsForVueModel[] = $equipmentForVueModel;
        }

        return $equipmentsForVueModel;
    }
}