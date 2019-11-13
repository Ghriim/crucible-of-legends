<?php

namespace App\Domain\UseCase;

abstract class AbstractUseCase
{
    protected function toJSON($data): string
    {
        return json_encode($data);
    }
}