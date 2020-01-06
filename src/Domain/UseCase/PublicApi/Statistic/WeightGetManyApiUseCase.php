<?php

namespace App\Domain\UseCase\PublicApi\Statistic;

use App\Domain\DataInteractor\DTOProvider\Statistic\WeightDTOProvider;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\GetManyUseCaseInterface;
use App\Domain\Vue\Presenter\PublicApi\Statistic\WeightGetManyVuePresenter;

final class WeightGetManyApiUseCase extends AbstractUseCase implements GetManyUseCaseInterface
{
    private $weightDtoProvider;
    private $presenter;

    public function __construct(
        WeightDTOProvider $weightDtoProvider,
        WeightGetManyVuePresenter $presenter
    )
    {
        $this->weightDtoProvider = $weightDtoProvider;
        $this->presenter = $presenter;
    }
    
    public function execute(array $parameters = []): array
    {
        $weightsHistory = $this->weightDtoProvider->loadHistoryForAUser($parameters['user']);
        if (true === empty($weightsHistory)) {
            return [];
        }

        return $this->presenter->buildMultipleObjectVueModel($weightsHistory);
    }
}