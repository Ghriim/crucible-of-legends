<?php

namespace App\Controller\Api\PublicApi\Workout;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Workout\DeleteExerciseApiUseCase;
use Symfony\Component\HttpFoundation\Response;

final class ExerciseApiController extends AbstractApiController
{
    public function delete(
        string $workoutName,
        int $exerciseId,
        DeleteExerciseApiUseCase $deleteExerciseApiUseCase
    ): Response
    {
        $deleteExerciseApiUseCase->execute($exerciseId, ['workoutName' => $workoutName]);

        return $this->buildResponse(null, true);
    }
}