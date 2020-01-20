<?php

namespace App\Controller\Api\PublicApi\Statistic;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Statistic\MeasurementGetManyApiUseCase;
use App\Domain\UseCase\PublicApi\Statistic\MeasurementGetSingleApiUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class MeasurementApiController extends AbstractApiController
{
    public function getMany(
        Request $request,
        MeasurementGetManyApiUseCase $getManyMeasurementApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getManyMeasurementApiUseCase->execute(['user' => $this->getCurrentUser($request)])
        );
    }

    public function getDefault(
        Request $request,
        MeasurementGetSingleApiUseCase $getSingleMeasurementApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getSingleMeasurementApiUseCase->execute(null, $request->query->all())
        );
    }

    public function getSingle(
        Request $request,
        int $id,
        MeasurementGetSingleApiUseCase $getSingleMeasurementApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getSingleMeasurementApiUseCase->execute($id, $request->query->all())
        );
    }
}