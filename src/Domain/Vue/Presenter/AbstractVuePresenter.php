<?php

namespace App\Domain\Vue\Presenter;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use Symfony\Component\Intl\Exception\NotImplementedException;

abstract class AbstractVuePresenter
{
    private const DATE_TIME_FORMAT = 'd/m/Y H:m';

    public function buildMultipleObjectVueModel(array $dtos): array
    {
        throw new NotImplementedException('method buildMultipleObjectVueModel has to be implemented for single object response API');
    }

    public function buildSingleObjectVueModel(AbstractBaseDTO $dto): AbstractBaseVueModel
    {
        throw new NotImplementedException('method buildSingleObjectVueModel has to be implemented for multiple objects response API');
    }

    protected function dateTimeToString(\DateTimeInterface $dateTime): string
    {
        return $dateTime->format(self::DATE_TIME_FORMAT);
    }
}