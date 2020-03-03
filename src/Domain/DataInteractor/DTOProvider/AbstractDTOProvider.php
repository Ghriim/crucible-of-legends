<?php

namespace App\Domain\DataInteractor\DTOProvider;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Repository\AbstractBaseEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * @deprecated
 */
abstract class AbstractDTOProvider
{
    protected const DEFAULT_ENTITY_MANAGER = 'default';
    protected const ORDER_DIRECTION_ASC = 'ASC';
    protected const ORDER_DIRECTION_DESC = 'DESC';

    protected $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    abstract protected function getEntityClassName(): string;

    /**
     * @param mixed $id
     *
     * @return object|AbstractBaseDTO|null
     */
    public function loadOneById($id)
    {
        if (null === $id) {
            return null;
        }

        return $this->getRepository()->find($id);
    }

    /**
     * @param string[] $criteria
     * @param string[] $selects
     */
    public function loadOneByCriteria(array $criteria = [], array $selects = []): ?AbstractBaseDTO
    {
        return $this->getRepository()->findOneByCriteria($criteria, $selects);
    }

    /**
     * @param mixed $ids
     *
     * @return AbstractBaseDTO[]
     */
    public function loadByIds(array $ids): array
    {
        if (true === empty($ids)) {
            return [];
        }

        return $this->getRepository()->findBy(['id' => $ids]);
    }

    /**
     * @return AbstractBaseEntityRepository
     */
    protected function getRepository(): EntityRepository
    {
        return $this->getEntityManager()->getRepository($this->getEntityClassName());
    }

    /**
     * @return ObjectManager|EntityManager
     */
    private function getEntityManager(?string $managerName = null): EntityManager
    {
        return $this->doctrine->getManager($managerName ?? static::DEFAULT_ENTITY_MANAGER);
    }
}