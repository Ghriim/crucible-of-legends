<?php

namespace App\Domain\Vue\Presenter\PublicApi\Statistic;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\Statistic\MeasurementDTO;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Model\PublicApi\Statistic\MeasurementPostVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\SingleObjectVuePresenterInterface;

class MeasurementPostVuePresenter extends AbstractVuePresenter implements SingleObjectVuePresenterInterface
{
    /**
     * @param MeasurementDTO $dto
     *
     * @return MeasurementPostVueModel
     */
    public function buildSingleObjectVueModel(AbstractBaseDTO $dto): AbstractBaseVueModel
    {
        $model = new MeasurementPostVueModel();

        $model->id = $dto->getId();

        return $model;
    }
}