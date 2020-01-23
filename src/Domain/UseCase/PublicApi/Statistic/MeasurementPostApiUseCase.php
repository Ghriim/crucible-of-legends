<?php

namespace App\Domain\UseCase\PublicApi\Statistic;

use App\Domain\DataInteractor\DTO\Statistic\MeasurementDTO;
use App\Domain\DataInteractor\DTOPersister\Statistic\MeasurementDTOPersister;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\PostUseCaseInterface;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Presenter\PublicApi\Statistic\MeasurementPostVuePresenter;

final class MeasurementPostApiUseCase extends AbstractUseCase implements PostUseCaseInterface
{
    private $measurementDtoPersister;
    private $presenter;

    public function __construct(
        MeasurementDTOPersister $measurementDtoPersister,
        MeasurementPostVuePresenter $presenter
    )
    {
        $this->measurementDtoPersister = $measurementDtoPersister;
        $this->presenter = $presenter;
    }

    public function execute(\stdClass $jsonObject, array $parameters = []): ?AbstractBaseVueModel
    {
        $measurement = new MeasurementDTO();
        $measurement->setUser($parameters['user']);
        $measurement->setBiceps($this->toIntOrNull($jsonObject->biceps));
        $measurement->setChest($this->toIntOrNull($jsonObject->chest));
        $measurement->setWaist($this->toIntOrNull($jsonObject->waist));
        $measurement->setThigh($this->toIntOrNull($jsonObject->thigh));

        $this->measurementDtoPersister->create($measurement);

        return $this->presenter->buildSingleObjectVueModel($measurement);
    }
}