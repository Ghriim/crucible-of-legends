<?php

namespace App\Domain\UseCase\PublicApi\Statistic;

use App\Domain\DataInteractor\DTOProvider\Statistic\MeasurementDTOProvider;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\GetManyUseCaseInterface;
use App\Domain\Vue\Presenter\PublicApi\Statistic\MeasurementGetManyVuePresenter;

final class MeasurementGetManyApiUseCase extends AbstractUseCase implements GetManyUseCaseInterface
{
    private $weightDtoProvider;
    private $presenter;

    public function __construct(
        MeasurementDTOProvider $weightDtoProvider,
        MeasurementGetManyVuePresenter $presenter
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