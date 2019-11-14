<?php

namespace App\Domain\DataInteractor\DTOPersister;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Tools\Clock\ClockInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;

abstract class AbstractDTOPersister
{
    protected const DEFAULT_ENTITY_MANAGER = 'default';

    /** @var ManagerRegistry */
    protected $doctrine;

    /** @var ClockInterface */
    protected $clock;

    public function __construct(ManagerRegistry $doctrine, ClockInterface $clock)
    {
        $this->doctrine = $doctrine;
        $this->clock = $clock;
    }

    abstract protected function getEntityClassName(): string;

    /**
     * @param AbstractBaseDTO[] $dtos
     *
     * @return AbstractBaseDTO[]
     */
    protected function saveAll(array $dtos, bool $flush = true): array
    {
        foreach ($dtos as $dto) {
            $this->save($dto, false);
        }

        try {
            if (true === $flush) {
                $this->getEntityManager()->flush();
            }
        } catch (ORMException $exception) {
            // TODO : do smth about the exception
        }

        return $dtos;
    }

    protected function save(AbstractBaseDTO $dto, bool $flush = true): AbstractBaseDTO
    {
        $this->handleSaveHistory($dto);

        if ($dto->isNew()) {
            try {
                $this->getEntityManager()->persist($dto);
            } catch (ORMException $exception) {
                // TODO : do smth about the exception
            }
        }

        if (true === $flush) {
            $this->flush();
        }

        return $dto;
    }

    /**
     * @param AbstractBaseDTO[] $dtos
     */
    protected function deleteAll(array $dtos, bool $flush = true): void
    {
        foreach ($dtos as $dto) {
            $this->delete($dto, false);
        }

        if (true === $flush) {
            $this->flush();
        }
    }

    protected function delete(AbstractBaseDTO $dto, bool $flush = true): void
    {
        $dto->setStatus(AbstractBaseDTO::STATUS_DELETED);

        $this->save($dto, $flush);
    }

    protected function flush(): void
    {
        try {
            $this->getEntityManager()->flush();
        } catch (ORMException $exception) {
            // TODO : do smth about the exception
        }
    }

    private function handleSaveHistory(AbstractBaseDTO $dto): void
    {
        $now = $this->clock->now();

        if (true === $dto->isNew()) {
            $dto->setCreatedDate($now);
        }

        $dto->setUpdatedDate($now);
    }

    /**
     * @return ObjectManager|EntityManager
     */
    private function getEntityManager(?string $managerName = null): EntityManager
    {
        return $this->doctrine->getManager($managerName ?? static::DEFAULT_ENTITY_MANAGER);
    }
}