<?php

namespace App\Domain\UseCase\PublicApi\Workout;

use App\Domain\DataInteractor\DTOPersister\Workout\WorkoutDTOPersister;
use App\Domain\DataInteractor\DTOProvider\Workout\WorkoutDTOProvider;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\DeleteUseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class WorkoutDeleteApiUseCase extends AbstractUseCase implements DeleteUseCaseInterface
{
    private $workoutDtoProvider;
    private $workoutDtoPersister;

    public function __construct(
        WorkoutDTOProvider $workoutDtoProvider,
        WorkoutDTOPersister $workoutDtoPersister
    )
    {
        $this->workoutDtoProvider = $workoutDtoProvider;
        $this->workoutDtoPersister = $workoutDtoPersister;
    }

    public function execute($workoutCanonicalName, array $parameters = []): void
    {
        $workout = $this->workoutDtoProvider->loadForDelete($workoutCanonicalName);
        if (null === $workout) {
            throw new NotFoundHttpException('No matching workout has been found');
        }

        $this->workoutDtoPersister->delete($workout);
    }
}