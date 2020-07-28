<?php

namespace App\Domain\UseCase\PublicApi\Workout;

use App\Domain\DataInteractor\DTOProvider\Workout\CategoryDTOProvider;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\GetManyUseCaseInterface;
use App\Domain\Vue\Model\PublicApi\Workout\CategoryGetManyVueModel;
use App\Domain\Vue\Presenter\PublicApi\Workout\CategoryGetManyVuePresenter;

final class CategoryGetManyApiUseCase extends AbstractUseCase implements GetManyUseCaseInterface
{
    private CategoryDTOProvider $dtoProvider;
    private CategoryGetManyVuePresenter $presenter;

    public function __construct(CategoryDTOProvider $dtoProvider, CategoryGetManyVuePresenter $presenter)
    {
        $this->dtoProvider = $dtoProvider;
        $this->presenter = $presenter;
    }

    /**
     * @return CategoryGetManyVueModel[}
     */
    public function execute(array $parameters = []): array
    {
        $referenceExercises = $this->dtoProvider->loadForGetMany(
            $this->buildSearchParameters($parameters)
        );

        return $this->presenter->buildMultipleObjectVueModel($referenceExercises);
    }

    private function buildSearchParameters(array $parameters): array
    {
        return [];
    }
}