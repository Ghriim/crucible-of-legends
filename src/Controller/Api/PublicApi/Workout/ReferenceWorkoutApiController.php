<?php

namespace App\Controller\Api\PublicApi\Workout;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Workout\ReferenceWorkoutGetManyApiUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ReferenceWorkoutApiController extends AbstractApiController
{
    public function getMany(
        Request $request,
        ReferenceWorkoutGetManyApiUseCase $getManyWorkoutApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getManyWorkoutApiUseCase->execute($request->query->all())
        );
    }
}