<?php

namespace App\Controller\Api\PublicApi\Workout;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Workout\ExerciseDeleteApiUseCase;
use App\Domain\UseCase\PublicApi\Workout\ExercisePostApiUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ExerciseApiController extends AbstractApiController
{
    public function post(
        Request $request,
        ExercisePostApiUseCase $exercisePostApiUseCase
    ): Response
    {
        $exercisePostApiUseCase->execute((object) $request->request->all());

        return $this->buildResponse(null, true);
    }

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