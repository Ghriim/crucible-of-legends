<?php

namespace App\Domain\Vue\Presenter;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\Vue\Model\AbstractBaseVueModel;

interface MultipleObjectVueModelInterface
{
    public function buildMultipleObjectVueModel(array $dtos): array;
}