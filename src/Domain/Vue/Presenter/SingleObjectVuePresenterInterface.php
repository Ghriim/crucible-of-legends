<?php

namespace App\Domain\Vue\Presenter;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\Vue\Model\AbstractBaseVueModel;

interface SingleObjectVuePresenterInterface
{
    public function buildSingleObjectVueModel(AbstractBaseDTO $dto): AbstractBaseVueModel;
}