<?php

namespace App\Domain\UseCase;

interface DeleteUseCaseInterface
{
    public function execute($exerciseId, array $parameters = []): void;
}