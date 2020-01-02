<?php

namespace App\Domain\DataInteractor\DTOProvider\User;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractDTOProvider;
use App\Domain\Exception\UserShouldExistException;

/**
 * @method UserDTO loadOneById($id)
 */
final class UserDTOProvider extends AbstractDTOProvider
{
    /**
     * @param int $id
     *
     * @return UserDTO
     * @throws UserShouldExistException
     */
    public function loadForGetCurrent(int $id): ?AbstractBaseDTO
    {
        $user = $this->loadOneByCriteria(['id' => $id]);

        if (null === $user) {
            throw new UserShouldExistException('Current user is load from token and should exist');
        }

        return $user;
    }

    protected function getEntityClassName(): string
    {
        return UserDTO::class;
    }
}