<?php

namespace App\Controller\Api\PublicApi\Workout;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Workout\GetManyWorkoutApiUseCase;
use App\Domain\UseCase\PublicApi\Workout\GetSingleWorkoutApiUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class WorkoutApiController extends AbstractApiController
{
    public function getMany(
        Request $request,
        GetManyWorkoutApiUseCase $getManyWorkoutApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getManyWorkoutApiUseCase->execute($request->query->all())
        );
    }

    public function getSingle(
        string $name,
        Request $request,
        GetSingleWorkoutApiUseCase $getSingleWorkoutApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getSingleWorkoutApiUseCase->execute($name, $request->query->all())
        );
    }
}