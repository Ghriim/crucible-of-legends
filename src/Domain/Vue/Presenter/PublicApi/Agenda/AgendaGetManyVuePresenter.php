<?php

namespace App\Domain\Vue\Presenter\PublicApi\Agenda;

use App\Domain\DataInteractor\DTO\Agenda\AgendaDTO;
use App\Domain\DataInteractor\DTO\Agenda\AgendaEntryDTO;
use App\Domain\Vue\Model\PublicApi\Agenda\AgendaGetManyEntryVueModel;
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
            $model->entries = $this->buildEntriesForVueModel($dto->getEntries());

            $models[] = $model;
        }

        return $models;
    }

    /**
     * @param AgendaEntryDTO[] $entries
     *
     * @return AgendaGetManyEntryVueModel[]
     */
    private function buildEntriesForVueModel(array $entries): array
    {
        $entryForVueModels = [];
        foreach ($entries as $entry) {
            $entryForVueModel = new AgendaGetManyEntryVueModel();
            $entryForVueModel->id = $entry->getId();
            $entryForVueModel->workoutName = $entry->getWorkout()->getName();
            $entryForVueModel->workoutCanonicalName = $entry->getWorkout()->getName();
            $entryForVueModel->programmedDate = $this->dateTimeToString($entry->getProgrammedDate());
            $entryForVueModel->completedDate = $this->dateTimeToString($entry->getCompletedDate());

            $entryForVueModels[] = $entryForVueModel;
        }

        return $entryForVueModels;
    }
}