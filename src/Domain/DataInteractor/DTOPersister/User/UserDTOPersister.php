<?php

namespace App\Domain\DataInteractor\DTOPersister\User;

use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\DataInteractor\DTOPersister\AbstractDTOPersister;
use App\Domain\DataInteractor\DTOPersister\Statistic\StatisticsOverviewDTOPersister;
use App\Tools\Clock\ClockInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

final class UserDTOPersister extends AbstractDTOPersister
{
    private $statisticsOverviewPersister;

    public function __construct(ManagerRegistry $doctrine, ClockInterface $clock, StatisticsOverviewDTOPersister $statisticsOverviewPersister)
    {
        parent::__construct($doctrine, $clock);

        $this->statisticsOverviewPersister = $statisticsOverviewPersister;
    }

    public function create(UserDTO $user): UserDTO
    {
        $this->save($user);

        $this->statisticsOverviewPersister->create($user);

        return $user;
    }

    protected function getEntityClassName(): string
    {
        return UserDTO::class;
    }
}