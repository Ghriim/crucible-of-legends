<?php

namespace App\Domain\DataInteractor\DTOProvider\Agenda;

use App\Domain\DataInteractor\DTO\Agenda\AgendaDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractDTOProvider;
use App\Repository\Agenda\AgendaDTORepository;

/**
 * @method AgendaDTORepository getRepository()
 * @method ?AgendaDTO loadOneById($id)
 * @method ?AgendaDTO loadOneByCriteria(array $criteria = [], array $selects = [])
 */
final class AgendaDTOProvider extends AbstractDTOProvider
{
    /**
     * @return AgendaDTO[]
     */
    public function loadForGetMany(array $criteria): array
    {
        return $this->getRepository()->findManyByCriteria($criteria);
    }

    public function loadForGetOneOrDefault(?int $identifier): ?AgendaDTO
    {
        if (null === $identifier) {
            return $this->loadOneByCriteria(['isDefault' => true], ['entries']);
        }

        return $this->loadOneByCriteria(['id' => $identifier], ['entries']);
    }

    protected function getEntityClassName(): string
    {
        return AgendaDTO::class;
    }
}