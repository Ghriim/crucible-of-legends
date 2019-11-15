<?php

namespace App\Domain\UseCase\PublicApi\Workout;

use App\Domain\DataInteractor\DTOProvider\Workout\WorkoutDTOProvider;
use App\Domain\UseCase\GetManyUseCaseInterface;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\Vue\Presenter\PublicApi\Workout\WorkoutGetManyVuePresenter;

final class WorkoutGetManyApiUseCase extends AbstractUseCase implements GetManyUseCaseInterface
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