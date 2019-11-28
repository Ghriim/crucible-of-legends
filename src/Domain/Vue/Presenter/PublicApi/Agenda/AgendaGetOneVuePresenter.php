<?php

namespace App\Domain\Vue\Presenter\PublicApi\Agenda;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\Agenda\AgendaDTO;
use App\Domain\DataInteractor\DTO\Agenda\AgendaEntryDTO;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Model\PublicApi\Agenda\AgendaGetSingleEntryVueModel;
use App\Domain\Vue\Model\PublicApi\Agenda\AgendaGetSingleVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\SingleObjectVuePresenterInterface;

final class AgendaGetOneVuePresenter extends AbstractVuePresenter implements SingleObjectVuePresenterInterface
{
    /**
     * @param AgendaDTO $dto
     *
     * @return AgendaGetSingleVueModel
     */
    public function buildSingleObjectVueModel(AbstractBaseDTO $dto): AbstractBaseVueModel
    {
        $model = new AgendaGetSingleVueModel();
        $model->id = $dto->getId();
        $model->name = $dto->getName();
        $model->entries = $this->buildEntriesForVueModel($dto->getEntries());

        return $model;
    }

    /**
     * @param AgendaEntryDTO[] $entries
     *
     * @return AgendaGetSingleEntryVueModel[]
     */
    private function buildEntriesForVueModel(array $entries): array
    {
        $entryForVueModels = [];
        foreach ($entries as $entry) {
            $entryForVueModel = new AgendaGetSingleEntryVueModel();
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