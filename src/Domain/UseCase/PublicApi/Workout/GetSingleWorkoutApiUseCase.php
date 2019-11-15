<?php

namespace App\Domain\UseCase\PublicApi\Workout;

use App\Domain\DataInteractor\DTOProvider\Workout\WorkoutDTOProvider;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\GetSingleUseCaseInterface;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Model\PublicApi\Workout\WorkoutGetSingleVueModel;
use App\Domain\Vue\Presenter\PublicApi\Workout\WorkoutGetSingleVuePresenter;

final class GetSingleWorkoutApiUseCase extends AbstractUseCase implements GetSingleUseCaseInterface
{
    private $workoutDtoProvider;
    private $presenter;

    public function __construct(
        WorkoutDTOProvider $workoutDtoProvider,
        WorkoutGetSingleVuePresenter $presenter
    )
    {
        $this->workoutDtoProvider = $workoutDtoProvider;
        $this->presenter = $presenter;
    }

    /**
     * @param string $identifier
     *
     * @return WorkoutGetSingleVueModel
     */
    public function execute($identifier, array $parameters): ?AbstractBaseVueModel
    {
        $workout = $this->workoutDtoProvider->loadForGetOne($identifier);
        if (null === $workout) {
            return null;
        }

        return $this->presenter->buildSingleObjectVueModel($workout);
    }
}