<?php

namespace App\Domain\Vue\Presenter\PublicApi\Statistic;

use App\Domain\DataInteractor\DTO\Statistic\WeightDTO;
use App\Domain\Vue\Model\PublicApi\Statistic\WeightGetManyVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\MultipleObjectVuePresenterInterface;

final class WeightGetManyVuePresenter extends AbstractVuePresenter implements MultipleObjectVuePresenterInterface
{
    /**
     * @param WeightDTO[] $dtos
     *
     * @return WeightGetManyVueModel[]
     */
    public function buildMultipleObjectVueModel(array $dtos): array
    {
        $models = [];
        foreach ($dtos as $dto) {
            $model = new WeightGetManyVueModel();
            $model->id = $dto->getId();
            $model->totalWeight = $this->getDisplayInKg($dto->getTotalWeight());
            $model->bodyMassIndex = $this->getDisplayFloat($dto->getBodyMassIndex());
            $model->bodyFatPercent = $this->getDisplayInPercent($dto->getBodyFatPercent());
            $model->createdDate = $this->dateString($dto->getCreatedDate());

            $models[] = $model;
        }

        return $models;
    }
}