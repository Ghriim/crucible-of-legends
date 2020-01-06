<?php

namespace App\Domain\DataInteractor\DTOProvider\Statistic;

use App\Domain\DataInteractor\DTO\Statistic\WeightDTO;
use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractDTOProvider;
use App\Repository\Statistic\WeightDTORepository;

/**
 * @method WeightDTORepository getRepository()
 */
final class WeightDTOProvider extends AbstractDTOProvider
{
    /**
     * @param UserDTO $user
     *
     * @return WeightDTO[]
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
        return WeightDTO::class;
    }
}