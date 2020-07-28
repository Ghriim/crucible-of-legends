<?php

namespace App\Domain\Vue\Presenter\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\Workout\BackUP\CategoryDTO;
use App\Domain\Vue\Model\PublicApi\Workout\CategoryGetManyVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\MultipleObjectVuePresenterInterface;

final class CategoryGetManyVuePresenter extends AbstractVuePresenter implements MultipleObjectVuePresenterInterface
{
    /**
     * @param CategoryDTO[] $dtos
     *
     * @return CategoryGetManyVueModel[]
     */
    public function buildMultipleObjectVueModel(array $dtos): array
    {
        $models = [];
        foreach ($dtos as $dto) {
            $model = new CategoryGetManyVueModel();
            $model->id = $dto->getId();
            $model->title = $dto->getTitle();

            $models[] = $model;
        }

        return $models;
    }
}