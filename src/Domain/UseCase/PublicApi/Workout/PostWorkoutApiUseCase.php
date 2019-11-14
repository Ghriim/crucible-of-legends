<?php

namespace App\Domain\UseCase\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\DataInteractor\DTOPersister\Workout\WorkoutDTOPersister;
use App\Domain\UseCase\AbstractPostUseCase;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Presenter\PublicApi\Workout\WorkoutPostVuePresenter;

final class PostWorkoutApiUseCase extends AbstractPostUseCase
{
    private $workoutDtoPersister;
    private $presenter;

    public function __construct(WorkoutDTOPersister $workoutDtoPersister, WorkoutPostVuePresenter $presenter)
    {
        $this->workoutDtoPersister = $workoutDtoPersister;
        $this->presenter = $presenter;
    }

    public function execute(\stdClass $jsonObject): ?AbstractBaseVueModel
    {
        $workout = new WorkoutDTO();
        $workout->setName($jsonObject->name);

        $this->workoutDtoPersister->create($workout);

        return $this->presenter->buildSingleObjectVueModel($workout);
    }
}