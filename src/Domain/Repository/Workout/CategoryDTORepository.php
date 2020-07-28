<?php

namespace App\Domain\Repository\Workout;

use App\Domain\DataInteractor\DTO\Workout\CategoryDTO;
use App\Domain\Repository\AbstractBaseRepository;

final class CategoryDTORepository extends AbstractBaseRepository
{
    protected function getDTOClassName(): string
    {
        return CategoryDTO::class;
    }


}