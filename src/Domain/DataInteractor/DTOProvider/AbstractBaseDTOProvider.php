<?php

namespace App\Domain\DataInteractor\DTOProvider;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\Repository\AbstractBaseRepository;

abstract class AbstractBaseDTOProvider
{
    protected AbstractBaseRepository $repository;

    /**
     * @return AbstractBaseDTO[]
     */
    public function getManyByCriteria(array $critieria = [], array $selects = [], array $orders = [], ?int $limit = null, ?int $offset = null): array
    {
        return $this->getRepository()->findManyByCriteria($critieria, $selects, $orders, $limit, $offset);
    }

    /**
     * @return AbstractBaseDTO|null
     */
    public function getOneByCriteria(array $critieria, array $selects = []): ?AbstractBaseDTO
    {
        return $this->getRepository()->findOneByCriteria($critieria, $selects);
    }

    public function exists(array $critieria): bool
    {
        return $this->getRepository()->exists($critieria);
    }

    protected function getRepository(): AbstractBaseRepository
    {
        return $this->repository;
    }
}