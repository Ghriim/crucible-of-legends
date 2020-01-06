<?php

namespace App\Controller\Api\PublicApi\Statistic;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Statistic\WeightGetManyApiUseCase;
use App\Domain\UseCase\PublicApi\Statistic\WeightGetSingleApiUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class WeightApiController extends AbstractApiController
{
    public function getMany(
        Request $request,
        WeightGetManyApiUseCase $getManyWeightApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getManyWeightApiUseCase->execute(['user' => $this->getCurrentUser($request)])
        );
    }

    public function getDefault(
        Request $request,
        WeightGetSingleApiUseCase $getSingleWeightApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getSingleWeightApiUseCase->execute(null, $request->query->all())
        );
    }

    public function getSingle(
        Request $request,
        int $id,
        WeightGetSingleApiUseCase $getSingleWeightApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getSingleWeightApiUseCase->execute($id, $request->query->all())
        );
    }
}