<?php

namespace App\Domain\UseCase;

use App\Domain\Vue\Model\AbstractBaseVueModel;

interface GetManyUseCaseInterface
{
    /**
     * @return AbstractBaseVueModel[]
     */
    public function execute(array $parameters = []): array;
}