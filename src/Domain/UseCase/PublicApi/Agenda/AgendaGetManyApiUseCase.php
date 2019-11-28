<?php

namespace App\Domain\UseCase\PublicApi\Agenda;

use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\DataInteractor\DTOProvider\Agenda\AgendaDTOProvider;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\GetManyUseCaseInterface;
use App\Domain\Vue\Presenter\PublicApi\Agenda\AgendaGetManyVuePresenter;

final class AgendaGetManyApiUseCase extends AbstractUseCase implements GetManyUseCaseInterface
{
    private $agendaDtoProvider;
    private $presenter;

    public function __construct(
        AgendaDTOProvider $agendaDtoProvider,
        AgendaGetManyVuePresenter $presenter
    )
    {
        $this->agendaDtoProvider = $agendaDtoProvider;
        $this->presenter = $presenter;
    }

    public function execute(array $parameters): array
    {
        $agendas = $this->agendaDtoProvider->loadForGetMany(
            $this->computeCriteriaFromCurrentUser($parameters['user'])
        );

        if (true === empty($agendas)){
            return [];
        }

        return $this->presenter->buildMultipleObjectVueModel($agendas);
    }

    public function computeCriteriaFromCurrentUser(UserDTO $user): array
    {
        if (true === $user->isAPlayer()) {
            return ['player' => $user->getId()];
        }

        return [];
    }
}