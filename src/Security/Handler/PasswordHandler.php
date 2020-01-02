<?php

namespace App\Security\Handler;

use App\Domain\DataInteractor\DTO\User\UserDTO;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class PasswordHandler
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function encode(UserDTO $user, string $plainPassword): string
    {
        return $this->passwordEncoder->encodePassword($user, $plainPassword);
    }
}