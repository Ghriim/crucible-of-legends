<?php

namespace App\Controller\Api\PublicApi\Agenda;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Agenda\AgendaGetManyApiUseCase;
use App\Domain\UseCase\PublicApi\Agenda\AgendaGetSingleApiUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class AgendaApiController extends AbstractApiController
{
    public function getMany(
        Request $request,
        AgendaGetManyApiUseCase $getManyAgendaApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getManyAgendaApiUseCase->execute(['user' => $this->getCurrentUser($request)])
        );
    }


    public function getDefault(
        Request $request,
        AgendaGetSingleApiUseCase $getSingleAgendaApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getSingleAgendaApiUseCase->execute(null, $request->query->all())
        );
    }

    public function getSingle(
        Request $request,
        int $id,
        AgendaGetSingleApiUseCase $getSingleAgendaApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getSingleAgendaApiUseCase->execute($id, $request->query->all())
        );
    }
}