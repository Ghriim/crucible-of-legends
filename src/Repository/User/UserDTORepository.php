<?php

namespace App\Repository\User;

use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Repository\AbstractBaseEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserDTORepository extends AbstractBaseEntityRepository implements UserProviderInterface, UserLoaderInterface
{
    /**
     * @param string|string[]|null $email
     */
    protected function addCriterionEmail(QueryBuilder $queryBuilder, $email): bool
    {
        return $this->addCriterion($queryBuilder, $this->getAlias(), 'email', $email);
    }




    public function getAlias(): string
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     *
     * Overridden method to use email instead of username
     */
    public function loadUserByUsername($email)
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
    public function supportsClass($class)
    {
        return $class === 'AppApp\Domain\DataInteractor\DTO\User\UserDTO';
    }


}