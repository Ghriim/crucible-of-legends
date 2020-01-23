<?php

namespace App\Domain\Vue\Presenter\PublicApi\Statistic;

use App\Domain\DataInteractor\DTO\Statistic\MeasurementDTO;
use App\Domain\Vue\Model\PublicApi\Statistic\MeasurementGetManyVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\MultipleObjectVuePresenterInterface;

final class MeasurementGetManyVuePresenter extends AbstractVuePresenter implements MultipleObjectVuePresenterInterface
{
    /**
     * @param MeasurementDTO[] $dtos
     *
     * @return MeasurementGetManyVueModel[]
     */
    public function buildMultipleObjectVueModel(array $dtos): array
    {
        $models = [];
        foreach ($dtos as $dto) {
            $model = new MeasurementGetManyVueModel();
            $model->id = $dto->getId();
            $model->biceps = $this->getDisplayInCm($dto->getBiceps());
            $model->chest = $this->getDisplayInCm($dto->getChest());
            $model->waist = $this->getDisplayInCm($dto->getWaist());
            $model->thigh = $this->getDisplayInCm($dto->getThigh());
            $model->createdDate = $this->dateString($dto->getCreatedDate());

            $models[] = $model;
        }

        return $models;
    }
}