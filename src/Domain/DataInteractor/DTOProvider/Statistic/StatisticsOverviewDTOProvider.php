<?php

namespace App\Domain\DataInteractor\DTOProvider\Statistic;

use App\Domain\DataInteractor\DTO\Statistic\StatisticsOverviewDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractDTOProvider;
use App\Repository\Statistic\StatisticsOverviewDTORepository;

/**
 * @method StatisticsOverviewDTORepository getRepository()
 */
final class StatisticsOverviewDTOProvider extends AbstractDTOProvider
{
    public function getByUserId(int $id): StatisticsOverviewDTO
    {
        return $this->getRepository()->findOneByCriteria(['user' => $id]);
    }

    protected function getEntityClassName(): string
    {
        return StatisticsOverviewDTO::class;
    }
}