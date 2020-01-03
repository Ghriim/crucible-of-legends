<?php

namespace App\Domain\UseCase\PublicApi\Workout;

use App\Domain\DataInteractor\DTOPersister\Workout\ExerciseDTOPersister;
use App\Domain\DataInteractor\DTOProvider\Workout\ExerciseDTOProvider;
use App\Domain\DataInteractor\DTOProvider\Workout\WorkoutDTOProvider;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\DeleteUseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ExerciseDeleteApiUseCase extends AbstractUseCase implements DeleteUseCaseInterface
{
    private $workoutDtoProvider;
    private $exerciseDtoProvider;
    private $exerciseDtoPersister;

    public function __construct(
        WorkoutDTOProvider $workoutDtoProvider,
        ExerciseDTOProvider $exerciseDtoProvider,
        ExerciseDTOPersister $exerciseDtoPersister
    )
    {
        $this->workoutDtoProvider = $workoutDtoProvider;
        $this->exerciseDtoProvider = $exerciseDtoProvider;
        $this->exerciseDtoPersister = $exerciseDtoPersister;
    }

    public function execute($exerciseId, array $parameters = []): void
    {
        $workout = $this->workoutDtoProvider->loadOneWithExercise($parameters['workoutName']);
        if (null === $workout) {
            throw new NotFoundHttpException('No matching workout has been found');
        }

        $exercise = $this->exerciseDtoProvider->loadOneById($exerciseId);
        if (null === $workout) {
            throw new NotFoundHttpException('No matching exercise has been found');
        }

        $this->exerciseDtoPersister->deleteFromWorkout($exercise);
    }
}