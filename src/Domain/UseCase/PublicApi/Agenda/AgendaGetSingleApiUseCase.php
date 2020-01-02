<?php

namespace App\Domain\UseCase\PublicApi\Agenda;

use App\Domain\DataInteractor\DTOProvider\Agenda\AgendaDTOProvider;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\GetSingleUseCaseInterface;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Presenter\PublicApi\Agenda\AgendaGetOneVuePresenter;

final class AgendaGetSingleApiUseCase extends AbstractUseCase implements GetSingleUseCaseInterface
{

    private $agendaDtoProvider;
    private $presenter;

    public function __construct(
        AgendaDTOProvider $agendaDtoProvider,
        AgendaGetOneVuePresenter $presenter
    )
    {
        $this->agendaDtoProvider = $agendaDtoProvider;
        $this->presenter = $presenter;
    }

    public function execute($identifier, array $parameters): ?AbstractBaseVueModel
    {
        $agenda = $this->agendaDtoProvider->loadForGetOneOrDefault($identifier);
        if (null === $agenda) {
            return null;
        }

        return $this->presenter->buildSingleObjectVueModel($agenda);
    }
}