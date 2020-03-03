<?php

namespace App\Controller\Api\PublicApi\Workout;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Workout\ReferenceWorkoutGetManyApiUseCase;
use App\Domain\UseCase\PublicApi\Workout\ReferenceWorkoutGetSingleApiUseCase;
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

    public function getSingle(
        string $canonicalName,
        Request $request,
        ReferenceWorkoutGetSingleApiUseCase $getSingleWorkoutApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getSingleWorkoutApiUseCase->execute($canonicalName, $request->query->all())
        );
    }
}