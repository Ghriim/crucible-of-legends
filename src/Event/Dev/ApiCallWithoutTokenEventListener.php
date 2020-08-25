<?php

namespace App\Event\Dev;

use App\Domain\DataInteractor\DTOProvider\User\UserDTOProvider;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ApiCallWithoutTokenEventListener
{
    private JWTTokenManagerInterface $tokenManager;
    private UserDTOProvider $userDtoProvider;
    private ?string $defaultUserUsername;
    private bool $autoAddToken;

    public function __construct(
        JWTTokenManagerInterface $tokenManager,
        UserDTOProvider $userDtoProvider,
        ?string $defaultUserUsername = null,
        bool $autoAddToken = false
    )
    {
        $this->tokenManager = $tokenManager;
        $this->userDtoProvider = $userDtoProvider;
        $this->defaultUserUsername = $defaultUserUsername;
        $this->autoAddToken = $autoAddToken;
    }

    public function addTokenToRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $path = $request->getPathInfo();
        if (false === $this->autoAddToken
            || null === $this->defaultUserUsername
            || $request->headers->has('Authorization')
            || 0 !== strpos($path, '/api')) {
            return;
        }

        $user = $this->userDtoProvider->loadByUsername($this->defaultUserUsername);
        if (null !== $user) {
            $token = $this->tokenManager->create($user);
            $request->headers->add(['Authorization' => "Bearer $token"]);
        }
    }
}