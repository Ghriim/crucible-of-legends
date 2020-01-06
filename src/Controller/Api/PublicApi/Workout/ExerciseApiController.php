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
        int $id,
        ExerciseDeleteApiUseCase $deleteExerciseApiUseCase
    ): Response
    {
        $deleteExerciseApiUseCase->execute($id, ['workoutName' => $workoutName]);

        return $this->buildResponse(null, true);
    }
}