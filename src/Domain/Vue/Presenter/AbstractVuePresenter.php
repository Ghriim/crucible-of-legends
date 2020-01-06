<?php

namespace App\Domain\Vue\Presenter;

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
}