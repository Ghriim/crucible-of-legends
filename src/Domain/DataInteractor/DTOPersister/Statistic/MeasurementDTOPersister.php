<?php

namespace App\Domain\DataInteractor\DTOPersister\Statistic;

use App\Domain\DataInteractor\DTO\Statistic\MeasurementDTO;
use App\Domain\DataInteractor\DTOPersister\AbstractDTOPersister;

final class MeasurementDTOPersister extends AbstractDTOPersister
{
    public function create(MeasurementDTO $dto): MeasurementDTO
    {
        $this->save($dto);

        return $dto;
    }

    protected function getEntityClassName(): string
    {
        return MeasurementDTO::class;
    }
}