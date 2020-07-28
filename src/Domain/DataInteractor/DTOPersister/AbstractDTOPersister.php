<?php

namespace App\Domain\DataInteractor\DTOPersister;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\Repository\AbstractBaseRepository;
use App\Tools\Clock\ClockInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;

abstract class AbstractDTOPersister
{
    protected AbstractBaseRepository $repository;
    protected ClockInterface $clock;

    public function __construct(ClockInterface $clock)
    {
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

        if (true === $flush) {
            $this->flush();
        }

        return $dtos;
    }

    protected function save(AbstractBaseDTO $dto, bool $flush = true): AbstractBaseDTO
    {
        $this->handleSaveHistory($dto);

        if ($dto->isNew()) {
            $this->repository->persist($dto);
        }

        if (true === $flush) {
            $this->flush();
        }

        return $dto;
    }

    /**
     * @param AbstractBaseDTO[] $dtos
     */
    protected function softDeleteAll(array $dtos, bool $flush = true): void
    {
        foreach ($dtos as $dto) {
            $this->softDelete($dto, false);
        }

        if (true === $flush) {
            $this->flush();
        }
    }

    protected function softDelete(AbstractBaseDTO $dto, bool $flush = true): void
    {
        $dto->setStatus(AbstractBaseDTO::STATUS_DELETED);

        $this->save($dto, $flush);
    }

    protected function flush(): void
    {
        $this->repository->flush();
    }

    private function handleSaveHistory(AbstractBaseDTO $dto): void
    {
        $now = $this->clock->now();

        if (true === $dto->isNew()) {
            //$dto->setCreatedDate($now);
        }

        //$dto->setUpdatedDate($now);
    }
}