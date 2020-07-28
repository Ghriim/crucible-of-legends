<?php

namespace App\Controller\Api\PublicApi\Workout;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Workout\CategoryGetManyApiUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryApiController extends AbstractApiController
{
    public function getMany(
        Request $request,
        CategoryGetManyApiUseCase $categoryGetManyApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $categoryGetManyApiUseCase->execute($request->query->all())
        );
    }
}