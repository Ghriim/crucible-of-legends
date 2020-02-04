<?php

namespace App\Event\Dev;

use App\Domain\DataInteractor\DTOProvider\User\UserDTOProvider;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ApiCallWithoutTokenEventListener
{
    private $tokenManager;
    private $userDtoProvider;
    private $defaultUserId;
    private $autoAddToken;

    public function __construct(
        JWTTokenManagerInterface $tokenManager,
        UserDTOProvider $userDtoProvider,
        ?int $defaultUserId = null,
        bool $autoAddToken = false
    )
    {
        $this->tokenManager = $tokenManager;
        $this->userDtoProvider = $userDtoProvider;
        $this->defaultUserId = $defaultUserId;
        $this->autoAddToken = $autoAddToken;
    }

    public function addTokenToRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $path = $request->getPathInfo();
        if (false === $this->autoAddToken
            || null === $this->defaultUserId
            || $request->headers->has('Authorization')
            || 0 !== strpos($path, '/api')) {
            return;
        }

        $user = $this->userDtoProvider->loadOneById($this->defaultUserId);
        if (null !== $user) {
            $token = $this->tokenManager->create($user);
            var_dump($token); die;
            $request->headers->add(['Authorization' => "Bearer $token"]);
        }
    }
}