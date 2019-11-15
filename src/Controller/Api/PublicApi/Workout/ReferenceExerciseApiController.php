<?php

namespace App\Controller\Api\PublicApi\Workout;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Workout\ReferenceExerciseGetManyApiUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ReferenceExerciseApiController extends AbstractApiController
{
    public function getMany(
        Request $request,
        ReferenceExerciseGetManyApiUseCase $referenceExerciseGetApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $referenceExerciseGetApiUseCase->execute($request->query->all())
        );
    }
}