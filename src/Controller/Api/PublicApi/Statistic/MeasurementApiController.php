<?php

namespace App\Controller\Api\PublicApi\Statistic;

use App\Controller\Api\AbstractApiController;
use App\Domain\Exception\UserShouldExistException;
use App\Domain\UseCase\PublicApi\Statistic\MeasurementGetManyApiUseCase;
use App\Domain\UseCase\PublicApi\Statistic\MeasurementGetSingleApiUseCase;
use App\Domain\UseCase\PublicApi\Statistic\MeasurementPostApiUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class MeasurementApiController extends AbstractApiController
{
    public function getMany(
        Request $request,
        MeasurementGetManyApiUseCase $getManyMeasurementApiUseCase
    ): Response
    {
        try {
            $user = $this->getCurrentUser($request);
        } catch (UserShouldExistException $exception) {
            return $this->currentUserWasNotFound();
        }

        return $this->buildResponse(
            $getManyMeasurementApiUseCase->execute(['user' => $user])
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

    public function post(
        Request $request,
        MeasurementPostApiUseCase $measurementPostApiUseCase
    ): Response
    {
        try {
            $user = $this->getCurrentUser($request);
        } catch (UserShouldExistException $exception) {
            return $this->currentUserWasNotFound();
        }

        return $this->buildResponse(
            $measurementPostApiUseCase->execute((object) $request->request->all(), ['user' => $user])
        );
    }
}