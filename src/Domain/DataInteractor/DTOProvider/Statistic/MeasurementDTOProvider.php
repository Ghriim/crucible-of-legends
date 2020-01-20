<?php

namespace App\Domain\DataInteractor\DTOProvider\Statistic;

use App\Domain\DataInteractor\DTO\Statistic\MeasurementDTO;
use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractDTOProvider;
use App\Repository\Statistic\MeasurementDTORepository;

/**
 * @method MeasurementDTORepository getRepository()
 */
final class MeasurementDTOProvider extends AbstractDTOProvider
{
    /**
     * @param UserDTO $user
     *
     * @return MeasurementDTO[]
     */
    public function loadHistoryForAUser(UserDTO $user): array
    {
        return $this->getRepository()->findManyByCriteria(
            ['user' => $user->getId()],
            [],
            ['createdDate' => self::ORDER_DIRECTION_DESC]
        );
    }

    protected function getEntityClassName(): string
    {
        return MeasurementDTO::class;
    }
}