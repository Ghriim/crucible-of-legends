<?php

namespace App\Domain\UseCase\PublicApi\Workout;

use App\Domain\DataInteractor\DTOProvider\Workout\WorkoutDTOProvider;
use App\Domain\UseCase\AbstractGetManyUseCase;
use App\Domain\Vue\Presenter\PublicApi\Workout\WorkoutGetManyVuePresenter;

final class GetManyWorkoutApiUseCase extends AbstractGetManyUseCase
{
    private $dtoProvider;
    private $presenter;

    public function __construct(WorkoutDTOProvider $dtoProvider, WorkoutGetManyVuePresenter $presenter)
    {
        $this->dtoProvider = $dtoProvider;
        $this->presenter = $presenter;
    }

    public function execute(array $parameters): array
    {
        $workouts = $this->dtoProvider->loadForGetMany();
        if (true === empty($workouts)) {
            return [];
        }

        return $this->presenter->buildMultipleObjectVueModel($workouts);
    }
}