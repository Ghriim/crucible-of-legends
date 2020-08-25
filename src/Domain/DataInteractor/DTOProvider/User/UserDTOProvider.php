<?php

namespace App\Domain\DataInteractor\DTOProvider\User;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractBaseDTOProvider;
use App\Domain\Exception\UserShouldExistException;
use App\Domain\Repository\User\UserDTORepository;

/**
 * @method UserDTO loadOneById($id)
 */
final class UserDTOProvider extends AbstractBaseDTOProvider
{
    public function __construct(UserDTORepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return AbstractBaseDTO|UserDTO|null
     *
     * @throws UserShouldExistException
     */
    public function loadForGetCurrent(string $id): UserDTO
    {
        $user = $this->getOneByCriteria(['id' => $id]);
        if (null === $user) {
            throw new UserShouldExistException('Current user is load from token and should exist');
        }

        return $user;
    }

    /**
     * @return AbstractBaseDTO|UserDTO|null
     */
    public function loadByUsername(string $username): ?UserDTO
    {
        return $this->getOneByCriteria(['username' => $username]);
    }
}