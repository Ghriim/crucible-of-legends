<?php

namespace App\Controller\Api\PublicApi\Workout;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Workout\ExerciseDeleteApiUseCase;
use Symfony\Component\HttpFoundation\Response;

final class ExerciseApiController extends AbstractApiController
{
    public function delete(
        string $workoutName,
        int $exerciseId,
        ExerciseDeleteApiUseCase $deleteExerciseApiUseCase
    ): Response
    {
        $deleteExerciseApiUseCase->execute($exerciseId, ['workoutName' => $workoutName]);

        return $this->buildResponse(null, true);
    }
}