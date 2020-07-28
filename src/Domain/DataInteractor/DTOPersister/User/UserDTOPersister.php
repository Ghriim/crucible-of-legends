<?php

namespace App\Domain\DataInteractor\DTOPersister\User;

use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\DataInteractor\DTOPersister\AbstractDTOPersister;
use App\Domain\Repository\User\UserDTORepository;
use App\Tools\Clock\ClockInterface;

final class UserDTOPersister extends AbstractDTOPersister
{
    public function __construct(UserDTORepository $repository, ClockInterface $clock)
    {
        parent::__construct($clock);

        $this->repository = $repository;
    }

    public function create(UserDTO $user): UserDTO
    {
        $this->save($user);

        return $user;
    }

    protected function getEntityClassName(): string
    {
        return UserDTO::class;
    }
}