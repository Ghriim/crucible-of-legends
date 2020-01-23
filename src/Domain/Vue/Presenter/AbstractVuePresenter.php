<?php

namespace App\Domain\Vue\Presenter;

use App\Tools\Math\MetricConverter;

abstract class AbstractVuePresenter
{
    private const DATE_TIME_FORMAT = 'd/m/Y H:m';
    private const DATE_FORMAT = 'd/m/Y';

    protected function dateTimeString(?\DateTimeInterface $dateTime): string
    {
        if (null === $dateTime) {
            return '';
        }

        return $dateTime->format(self::DATE_TIME_FORMAT);
    }

    protected function dateString(?\DateTimeInterface $dateTime): string
    {
        if (null === $dateTime) {
            return '';
        }

        return $dateTime->format(self::DATE_FORMAT);
    }

    protected function getDisplayInCm(?int $valueInMm): ?string
    {
        $formattedValue = $this->getDisplayNumber(MetricConverter::mmToCm($valueInMm));

        return null === $formattedValue ? null : $formattedValue . ' cm';
    }

    protected function getDisplayInKg(?int $value): ?string
    {
        $formattedValue = $this->getDisplayNumber(MetricConverter::grToKg($value));

        return null === $formattedValue ? null : $formattedValue . ' kg';
    }

    protected function getDisplayFloat(?float $value): ?string
    {
        $formattedValue = $this->getDisplayNumber($value);

        return null === $formattedValue ? null : $formattedValue . '';
    }

    protected function getDisplayInPercent(?float $value): ?string
    {
        $formattedValue = $this->getDisplayNumber($value);

        return null === $formattedValue ? null : $formattedValue . ' %';
    }

    private function getDisplayNumber($value): ?string
    {
        if (null === $value) {
            return null;
        }

        return number_format($value, 2, ',', '');
    }
}