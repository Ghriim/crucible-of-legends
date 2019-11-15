<?php

namespace App\Controller\Api\PublicApi\Workout;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Workout\WorkoutGetManyApiUseCase;
use App\Domain\UseCase\PublicApi\Workout\WorkoutGetSingleApiUseCase;
use App\Domain\UseCase\PublicApi\Workout\WorkoutPostApiUseCaseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class WorkoutApiController extends AbstractApiController
{
    public function getMany(
        Request $request,
        WorkoutGetManyApiUseCase $getManyWorkoutApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getManyWorkoutApiUseCase->execute($request->query->all())
        );
    }

    public function getSingle(
        string $workoutName,
        Request $request,
        WorkoutGetSingleApiUseCase $getSingleWorkoutApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getSingleWorkoutApiUseCase->execute($workoutName, $request->query->all())
        );
    }

    public function post(
        Request $request,
        WorkoutPostApiUseCaseInterface $postWorkoutApiUseCase
    ) :Response
    {
        return $this->buildResponse(
            $postWorkoutApiUseCase->execute(json_decode($request->getContent()))
        );
    }

    public function put() :Response
    {
        return new Response('OK put!');
    }

    public function delete() :Response
    {
        return new Response('OK delete!');
    }
}