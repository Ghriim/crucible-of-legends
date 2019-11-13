<?php

namespace App\Domain\UseCase\PublicApi\Workout;

use App\Domain\DataInteractor\DTOProvider\Workout\WorkoutDTOProvider;
use App\Domain\UseCase\AbstractGetSingleUseCase;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Model\PublicApi\Workout\WorkoutGetSingleVueModel;
use App\Domain\Vue\Presenter\PublicApi\Workout\WorkoutGetSingleVuePresenter;

final class GetSingleWorkoutApiUseCase extends AbstractGetSingleUseCase
{
    private $dtoProvider;
    private $presenter;

    public function __construct(WorkoutDTOProvider $dtoProvider, WorkoutGetSingleVuePresenter $presenter)
    {
        $this->dtoProvider = $dtoProvider;
        $this->presenter = $presenter;
    }

    /**
     * @param string $identifier
     *
     * @return WorkoutGetSingleVueModel
     */
    public function execute($identifier, array $parameters): ?AbstractBaseVueModel
    {
        $workout = $this->dtoProvider->loadForGetOne($identifier);
        if (null === $workout) {
            return null;
        }

        return $this->presenter->buildSingleObjectVueModel($workout);
    }
}