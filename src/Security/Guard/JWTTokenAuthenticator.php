<?php

namespace App\Security\Guard;

use Lexik\Bundle\JWTAuthenticationBundle\Security\Guard\JWTTokenAuthenticator as BaseJWTTokenAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

final class JWTTokenAuthenticator extends BaseJWTTokenAuthenticator
{
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        //TODO : handle events ?
    }
}