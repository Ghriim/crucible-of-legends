<?php

namespace App\Domain\DataInteractor\DTOPersister\Statistic;

use App\Domain\DataInteractor\DTO\Statistic\WeightDTO;
use App\Domain\DataInteractor\DTOPersister\AbstractDTOPersister;
use App\Domain\DataInteractor\DTOProvider\Statistic\StatisticsOverviewDTOProvider;
use App\Tools\Clock\ClockInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

final class WeightDTOPersister extends AbstractDTOPersister
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

    public function create(WeightDTO $weight): WeightDTO
    {
        $this->save($weight);

        $statisticsOverview = $this->statisticsOverviewDtoProvider->getByUserId($weight->getUser()->getId());
        $this->statisticsOverviewPersister->updateWeightOverview($statisticsOverview, $weight);

        return $weight;
    }

    protected function getEntityClassName(): string
    {
        return WeightDTO::class;
    }
}