<?php

namespace App\Domain\Vue\Model\PublicApi\Statistic;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class WeightGetManyVueModel extends AbstractBaseVueModel
{
    /** @var float|null */
    public $totalWeight;

    /** @var float|null */
    public $bodyFatPercent;

    /** @var float|null */
    public $bodyMassIndex;

    /** @var string */
    public $createdDate;
}