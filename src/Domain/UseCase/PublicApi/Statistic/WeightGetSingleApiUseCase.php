<?php

namespace App\Domain\UseCase\PublicApi\Statistic;

use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\GetSingleUseCaseInterface;
use App\Domain\Vue\Model\AbstractBaseVueModel;

final class WeightGetSingleApiUseCase extends AbstractUseCase implements GetSingleUseCaseInterface
{
    public function execute($identifier, array $parameters = []): ?AbstractBaseVueModel
    {
    }
}