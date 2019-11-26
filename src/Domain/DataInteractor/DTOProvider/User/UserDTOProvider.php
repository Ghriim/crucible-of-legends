<?php

namespace App\Domain\DataInteractor\DTOProvider\User;

use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractDTOProvider;

/**
 * @method UserDTO loadOneById($id)
 */
final class UserDTOProvider extends AbstractDTOProvider
{
    protected function getEntityClassName(): string
    {
        return UserDTO::class;
    }
}