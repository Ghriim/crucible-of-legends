<?php

namespace App\Domain\DataInteractor\DTOPersister\Statistic;

use App\Domain\DataInteractor\DTO\Statistic\WeightDTO;
use App\Domain\DataInteractor\DTOPersister\AbstractDTOPersister;

final class WeightDTOPersister extends AbstractDTOPersister
{
    protected function getEntityClassName(): string
    {
        return WeightDTO::class;
    }
}