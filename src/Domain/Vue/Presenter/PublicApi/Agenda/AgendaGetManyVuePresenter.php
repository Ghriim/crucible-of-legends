<?php

namespace App\Domain\Vue\Presenter\PublicApi\Agenda;

use App\Domain\DataInteractor\DTO\Agenda\AgendaDTO;
use App\Domain\Vue\Model\PublicApi\Agenda\AgendaGetManyVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\MultipleObjectVuePresenterInterface;

class AgendaGetManyVuePresenter extends AbstractVuePresenter implements MultipleObjectVuePresenterInterface
{
    /**
     * @param AgendaDTO[] $dtos
     *
     * @return AgendaGetManyVueModel[]
     */
    public function buildMultipleObjectVueModel(array $dtos): array
    {
        $models = [];
        foreach ($dtos as $dto) {
            $model = new AgendaGetManyVueModel();
            $model->id = $dto->getId();
            $model->name = $dto->getName();

            $models[] = $model;
        }

        return $models;
    }
}