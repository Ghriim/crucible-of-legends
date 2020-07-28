<?php

namespace App\Domain\DataInteractor\DTOProvider\Workout;

use App\Domain\DataInteractor\DTO\Workout\CategoryDTO;
use App\Domain\DataInteractor\DTOProvider\AbstractBaseDTOProvider;
use App\Domain\Repository\Workout\CategoryDTORepository;

final class CategoryDTOProvider extends AbstractBaseDTOProvider
{
    public function __construct(CategoryDTORepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return CategoryDTO[]
     */
    public function loadForGetMany(array $parameters): array
    {
        return $this->getManyByCriteria($parameters);
    }
}