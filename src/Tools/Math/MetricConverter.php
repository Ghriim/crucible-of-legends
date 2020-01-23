<?php

namespace App\Tools\Math;

final class MetricConverter
{
    public static function mmToCm(?int $value): ?float
    {
        if (null === $value) {
            return null;
        }

        return $value / 100;
    }

    public static function grToKg(?int $value): ?float
    {
        if (null === $value) {
            return null;
        }

        return $value / 1000;
    }
}