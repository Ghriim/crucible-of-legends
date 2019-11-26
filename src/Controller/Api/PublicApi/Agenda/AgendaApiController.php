<?php

namespace App\Controller\Api\PublicApi\Agenda;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\Agenda\AgendaGetManyApiUseCase;
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

}