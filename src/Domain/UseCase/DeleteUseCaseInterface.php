<?php

namespace App\Domain\UseCase;

interface DeleteUseCaseInterface
{
    public function execute(int $exerciseId, array $parameters): void;
}