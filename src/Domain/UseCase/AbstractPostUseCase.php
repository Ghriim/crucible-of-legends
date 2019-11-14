<?php

namespace App\Domain\UseCase;

use App\Domain\Vue\Model\AbstractBaseVueModel;

abstract class AbstractPostUseCase extends AbstractUseCase
{
    abstract public function execute(\stdClass $jsonObject): ?AbstractBaseVueModel;
}