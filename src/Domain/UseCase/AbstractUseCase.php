<?php

namespace App\Domain\UseCase;

abstract class AbstractUseCase
{
    protected function toJSON($data): string
    {
        return json_encode($data);
    }

    protected function toIntOrNull(string $value): ?int
    {
        return '' === $value ? null : (int) $value;
    }

    protected function toFloatOrNull(string $value): ?float
    {
        return '' === $value ? null : (float) $value;
    }
}