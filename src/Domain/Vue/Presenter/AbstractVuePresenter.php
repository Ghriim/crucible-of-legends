<?php

namespace App\Domain\Vue\Presenter;

abstract class AbstractVuePresenter
{
    private const DATE_TIME_FORMAT = 'd/m/Y H:m';

    protected function dateTimeToString(?\DateTimeInterface $dateTime): string
    {
        if (null === $dateTime) {
            return '';
        }

        return $dateTime->format(self::DATE_TIME_FORMAT);
    }
}