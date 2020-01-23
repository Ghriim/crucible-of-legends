<?php

namespace App\Controller\Api;

use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\DataInteractor\DTOProvider\User\UserDTOProvider;
use App\Domain\Exception\UserShouldExistException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiController extends AbstractController
{
    private $userDTOProvider;

    public function __construct(UserDTOProvider $userDTOProvider)
    {
        $this->userDTOProvider = $userDTOProvider;
    }

    protected function getCurrentUserId(Request $request): int
    {
        // TODO: Use id from token
        return 1;
    }

    protected function getCurrentUser(Request $request): UserDTO
    {
        $user = $this->userDTOProvider->loadOneById($this->getCurrentUserId($request));
        if (null === $user) {
            throw new UserShouldExistException('User is load from JWT Token Id. It should exist !');
        }

        return $user;
    }

    protected function buildResponse($data, bool $emptyResponse = false): Response
    {
        if (true === $emptyResponse) {
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        }

        return $this->toJSON($data);
    }

    protected function currentUserWasNotFound(): JsonResponse
    {
        return new JsonResponse('', Response::HTTP_UNAUTHORIZED);
    }

    private function toJSON($data): JsonResponse
    {
        if (null === $data) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        if (true === empty($data)) {
            return new JsonResponse([], Response::HTTP_OK);
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
}