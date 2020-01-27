<?php

namespace App\Domain\DataInteractor\DTOPersister\Statistic;

use App\Domain\DataInteractor\DTO\Statistic\MeasurementDTO;
use App\Domain\DataInteractor\DTOPersister\AbstractDTOPersister;
use App\Domain\DataInteractor\DTOProvider\Statistic\StatisticsOverviewDTOProvider;
use App\Tools\Clock\ClockInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

final class MeasurementDTOPersister extends AbstractDTOPersister
{
    private $statisticsOverviewDtoProvider;
    private $statisticsOverviewPersister;

    public function __construct(
        ManagerRegistry $doctrine,
        ClockInterface $clock,
        StatisticsOverviewDTOProvider $statisticsOverviewDtoProvider,
        StatisticsOverviewDTOPersister $statisticsOverviewPersister
    )
    {
        parent::__construct($doctrine, $clock);

        $this->statisticsOverviewDtoProvider = $statisticsOverviewDtoProvider;
        $this->statisticsOverviewPersister = $statisticsOverviewPersister;
    }

    public function create(MeasurementDTO $measurement): MeasurementDTO
    {
        $this->save($measurement);

        $statisticsOverview = $this->statisticsOverviewDtoProvider->getByUserId($measurement->getUser()->getId());
        $this->statisticsOverviewPersister->updateMeasurementOverview($statisticsOverview, $measurement);

        return $measurement;
    }

    protected function getEntityClassName(): string
    {
        return MeasurementDTO::class;
    }
}