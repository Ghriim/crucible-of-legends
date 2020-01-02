<?php

namespace App\Domain\DataInteractor\DTOPersister\User;

use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\DataInteractor\DTOPersister\AbstractDTOPersister;

final class UserDTOPersister extends AbstractDTOPersister
{
    public function create(UserDTO $dto): UserDTO
    {
        $this->save($dto);

        return $dto;
    }

    protected function getEntityClassName(): string
    {
        return UserDTO::class;
    }
}