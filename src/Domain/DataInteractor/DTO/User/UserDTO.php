<?php

namespace App\Domain\DataInteractor\DTO\User;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;

class UserDTO extends AbstractBaseDTO
{
    private const TYPE_PLAYER = 'player';
    private const TYPE_COACH = 'coach';
    private const TYPE_ADMIN = 'admin';

    /** @var string */
    private $username;

    /** @var string */
    private $email;

    /** @var string */
    private $password;

    /** @var string */
    private $type = self::TYPE_PLAYER;

    protected function getDefaultStatus(): string
    {
        return self::STATUS_ACTIVE;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function isAPlayer(): bool
    {
        return self::TYPE_PLAYER === $this->getType();
    }

    public function isAPCoach(): bool
    {
        return self::TYPE_COACH === $this->getType();
    }

    public function isAnAdmin(): bool
    {
        return self::TYPE_ADMIN === $this->getType();
    }
}