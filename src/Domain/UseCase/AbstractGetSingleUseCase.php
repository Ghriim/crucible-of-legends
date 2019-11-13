<?php

namespace App\Domain\UseCase;

use App\Domain\Vue\Model\AbstractBaseVueModel;

abstract class AbstractGetSingleUseCase extends AbstractUseCase
{
    /**
     * @param int|string $identifier
     */
    abstract public function execute($identifier, array $parameters): ?AbstractBaseVueModel;
}