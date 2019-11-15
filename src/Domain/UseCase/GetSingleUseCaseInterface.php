<?php

namespace App\Domain\UseCase;

use App\Domain\Vue\Model\AbstractBaseVueModel;

interface GetSingleUseCaseInterface
{
    /**
     * @param int|string $identifier
     */
    public function execute($identifier, array $parameters): ?AbstractBaseVueModel;
}