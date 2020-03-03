<?php

namespace App\Domain\Repository\User;

use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\Repository\AbstractBaseRepository;
use App\Infrastructure\Adapter\QueryBuilderAdapter as QueryBuilder;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Todo: User adapter for security part
 */
final class UserDTORepository extends AbstractBaseRepository implements UserProviderInterface, UserLoaderInterface
{
    protected function getDTOClassName(): string
    {
        return UserDTO::class;
    }

    /**
     * @param string|string[]|null $email
     */
    protected function addCriterionEmail(QueryBuilder $queryBuilder, $email): bool
    {
        return $this->addCriterion($queryBuilder,'email', $email);
    }
    /**
     * @param string|string[]|null $username
     */
    protected function addCriterionUsername(QueryBuilder $queryBuilder, $username): bool
    {
        return $this->addCriterion($queryBuilder, 'username', $username);
    }


    ####################################################################################################################
    #                                              Override for security                                               #
    ####################################################################################################################

    /**
     * {@inheritdoc}
     *
     * Overridden method to use email instead of username
     */
    public function loadUserByUsername(string $email)
    {
        return $this->findOneByCriteria(['email' => $email]);
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof UserDTO) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getEmail());
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass(string $class)
    {
        return $class === 'App\Domain\DataInteractor\DTO\User\UserDTO';
    }
}