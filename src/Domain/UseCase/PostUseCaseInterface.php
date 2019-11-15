<?php

namespace App\Domain\UseCase;

use App\Domain\Vue\Model\AbstractBaseVueModel;

interface PostUseCaseInterface
{
    public function execute(\stdClass $jsonObject): ?AbstractBaseVueModel;
}