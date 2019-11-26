<?php

namespace App\Domain\DataInteractor\DTOProvider\Agenda;

use App\Domain\DataInteractor\DTO\Agenda\AgendaDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractDTOProvider;
use App\Repository\Agenda\AgendaDTORepository;

/**
 * @method AgendaDTORepository getRepository()
 */
final class AgendaDTOProvider extends AbstractDTOProvider
{
    /**
     * @return AgendaDTO[]
     */
    public function loadForGetMany(array $criteria): array
    {
        return $this->getRepository()->findManyByCriteria($criteria, ['entries']);
    }

    protected function getEntityClassName(): string
    {
        return AgendaDTO::class;
    }
}