<?php

namespace App\Domain\UseCase;

use App\Domain\Vue\Model\AbstractBaseVueModel;

abstract class AbstractGetManyUseCase extends AbstractUseCase
{
    /**
     * @return AbstractBaseVueModel[]
     */
    abstract public function execute(array $parameters): array;
}