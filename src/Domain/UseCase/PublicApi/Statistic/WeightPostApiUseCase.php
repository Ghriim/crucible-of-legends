<?php

namespace App\Domain\UseCase\PublicApi\Statistic;

use App\Domain\DataInteractor\DTO\Statistic\WeightDTO;
use App\Domain\DataInteractor\DTOPersister\Statistic\WeightDTOPersister;
use App\Domain\DataInteractor\DTOProvider\User\UserDTOProvider;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\PostUseCaseInterface;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Presenter\PublicApi\Statistic\WeightPostVuePresenter;

class WeightPostApiUseCase extends AbstractUseCase implements PostUseCaseInterface
{
    private $weightDtoPersister;
    private $presenter;

    public function __construct(
        UserDTOProvider $userDtoProvider,
        WeightDTOPersister $weightDtoPersister,
        WeightPostVuePresenter $presenter
    )
    {
        $this->weightDtoPersister = $weightDtoPersister;
        $this->presenter = $presenter;
    }

    public function execute(\stdClass $jsonObject, array $parameters = []): ?AbstractBaseVueModel
    {
        $weight = new WeightDTO();
        $weight->setUser($parameters['user']);
        $weight->setTotalWeight($this->toFloatOrNull($jsonObject->totalWeight));
        $weight->setBodyMassIndex($this->toFloatOrNull($jsonObject->bodyMassIndex));
        $weight->setBodyFatPercent($this->toFloatOrNull($jsonObject->bodyFatPercent));

        $this->weightDtoPersister->create($weight);

        return $this->presenter->buildSingleObjectVueModel($weight);
    }
}