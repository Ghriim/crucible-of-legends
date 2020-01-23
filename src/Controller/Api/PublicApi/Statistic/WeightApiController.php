<?php

namespace App\Controller\Api\PublicApi\Statistic;

use App\Controller\Api\AbstractApiController;
use App\Domain\Exception\UserShouldExistException;
use App\Domain\UseCase\PublicApi\Statistic\WeightGetManyApiUseCase;
use App\Domain\UseCase\PublicApi\Statistic\WeightGetSingleApiUseCase;
use App\Domain\UseCase\PublicApi\Statistic\WeightPostApiUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class WeightApiController extends AbstractApiController
{
    public function getMany(
        Request $request,
        WeightGetManyApiUseCase $getManyWeightApiUseCase
    ): Response
    {
        try {
            $user = $this->getCurrentUser($request);
        } catch (UserShouldExistException $exception) {
            return $this->currentUserWasNotFound();
        }

        return $this->buildResponse(
            $getManyWeightApiUseCase->execute(['user' => $user])
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

    public function post(
        Request $request,
        WeightPostApiUseCase $weightPostApiUseCase
    ): Response
    {
        try {
            $user = $this->getCurrentUser($request);
        } catch (UserShouldExistException $exception) {
            return $this->currentUserWasNotFound();
        }

        return $this->buildResponse(
            $weightPostApiUseCase->execute((object) $request->request->all(), ['user' => $user])
        );
    }
}