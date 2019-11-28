<?php

namespace App\Controller\Api\PublicApi\Agenda;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Agenda\AgendaGetManyApiUseCase;
use App\Domain\UseCase\PublicApi\Agenda\AgendaGetOneApiUseCase;
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
        AgendaGetOneApiUseCase $getOneAgendaApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getOneAgendaApiUseCase->execute(null, $request->query->all())
        );
    }

    public function getOne(
        Request $request,
        int $id,
        AgendaGetOneApiUseCase $getOneAgendaApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $getOneAgendaApiUseCase->execute($id, $request->query->all())
        );
    }
}