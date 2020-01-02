<?php

namespace App\Controller\Api\PublicApi\User;

use App\Controller\Api\AbstractApiController;
use App\Domain\UseCase\PublicApi\User\UserGetCurrentApiUseCase;
use App\Domain\UseCase\PublicApi\User\UserRegistrationApiUseCaseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class UserApiController extends AbstractApiController
{
    public function getCurrent(
        Request $request,
        UserGetCurrentApiUseCase $userGetSingleApiUseCase
    ): Response
    {
        return $this->buildResponse(
            $userGetSingleApiUseCase->execute($this->getCurrentUserId($request), $request->query->all())
        );
    }

    public function registration(
        Request $request,
        UserRegistrationApiUseCaseInterface $userRegistrationApiUseCase
    ) :Response
    {
        return $this->buildResponse(
            $userRegistrationApiUseCase->execute(json_decode($request->getContent()))
        );
    }
}