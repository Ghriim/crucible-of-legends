<?php

namespace App\Domain\UseCase\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\Workout\ExerciseDTO;
use App\Domain\DataInteractor\DTO\Workout\ReferenceExerciseDTO;
use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\DataInteractor\DTOPersister\Workout\ExerciseDTOPersister;
use App\Domain\DataInteractor\DTOProvider\Workout\ReferenceExerciseDTOProvider;
use App\Domain\DataInteractor\DTOProvider\Workout\WorkoutDTOProvider;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\PostUseCaseInterface;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ExercisePostApiUseCase extends AbstractUseCase implements PostUseCaseInterface
{
    private $workoutDtoProvider;
    private $referenceExerciseDtoProvider;
    private $exerciseDtoPersister;

    public function __construct(
        WorkoutDTOProvider $workoutDtoProvider,
        ReferenceExerciseDTOProvider $referenceExerciseDTOProvider,
        ExerciseDTOPersister $exerciseDtoPersister
    )
    {
        $this->workoutDtoProvider = $workoutDtoProvider;
        $this->referenceExerciseDtoProvider = $referenceExerciseDTOProvider;
        $this->exerciseDtoPersister = $exerciseDtoPersister;
    }

    public function execute(\stdClass $jsonObject): ?AbstractBaseVueModel
    {
        $workout = $this->workoutDtoProvider->loadOneWithExercise($jsonObject->workoutCanonicalName);
        if (null === $workout) {
            throw new NotFoundHttpException('Not matching workout has been found');
        }

        $referenceExercise = $this->referenceExerciseDtoProvider->loadOneById($jsonObject->referenceExerciseId);
        if (null === $referenceExercise) {
            throw new NotFoundHttpException('Not matching reference exercise has been found');
        }

        $this->exerciseDtoPersister->addToWorkout(
            $this->buildExerciseDTO($workout, $referenceExercise, $jsonObject)
        );

        return null;
    }

    private function buildExerciseDTO(WorkoutDTO $workout, ReferenceExerciseDTO $referenceExercise, $jsonObject): ExerciseDTO
    {
        $exercise = new ExerciseDTO();
        $exercise->setWorkout($workout);
        $exercise->setReferenceExercise($referenceExercise);
        $exercise->setPosition($workout->getHighestPosition() + 1);
        $exercise->setDurationProgrammed($jsonObject->durationProgrammed);
        $exercise->setRepetitionsProgrammed($jsonObject->repetitionsProgrammed);
        $exercise->setWeightProgrammed($jsonObject->weightProgrammed);

        return $exercise;
    }
}