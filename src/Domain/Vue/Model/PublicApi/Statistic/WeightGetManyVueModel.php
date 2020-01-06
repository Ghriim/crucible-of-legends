<?php

namespace App\Domain\Vue\Model\PublicApi\Statistic;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class WeightGetManyVueModel extends AbstractBaseVueModel
{
    /** @var float */
    public $totalWeight;

    /** @var float */
    public $bodyFatPercent;

    /** @var float */
    public $bodyMassIndex;

    /** @var string */
    public $createdDate;
}