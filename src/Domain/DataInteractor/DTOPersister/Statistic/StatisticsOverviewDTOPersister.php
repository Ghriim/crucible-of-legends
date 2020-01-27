<?php

namespace App\Domain\DataInteractor\DTOPersister\Statistic;

use App\Domain\DataInteractor\DTO\Statistic\MeasurementDTO;
use App\Domain\DataInteractor\DTO\Statistic\StatisticsOverviewDTO;
use App\Domain\DataInteractor\DTO\Statistic\WeightDTO;
use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\DataInteractor\DTOPersister\AbstractDTOPersister;

final class StatisticsOverviewDTOPersister extends AbstractDTOPersister
{
    public function create(UserDTO $user): StatisticsOverviewDTO
    {
        $statisticsOverview = new StatisticsOverviewDTO();
        $statisticsOverview->setUser($user);

        $this->save($statisticsOverview);

        return $statisticsOverview;
    }

    public function updateWeightOverview(StatisticsOverviewDTO $statisticsOverview, WeightDTO $weight): StatisticsOverviewDTO
    {
        if (null === $statisticsOverview->getFirstWeight()) {
            $statisticsOverview->setFirstWeight($weight);
        }

        $statisticsOverview->setLastWeight($weight);

        $this->save($statisticsOverview);

        return $statisticsOverview;
    }

    public function updateMeasurementOverview(StatisticsOverviewDTO $statisticsOverview, MeasurementDTO $measurement): StatisticsOverviewDTO
    {
        if (null === $statisticsOverview->getFirstMeasurement()) {
            $statisticsOverview->setFirstMeasurement($measurement);
        }

        $statisticsOverview->setLastMeasurement($measurement);

        $this->save($statisticsOverview);

        return $statisticsOverview;
    }

    protected function getEntityClassName(): string
    {
        return StatisticsOverviewDTO::class;
    }
}