<?php

namespace App\Domain\Vue\Model\PublicApi\Statistic;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class WeightGetManyVueModel extends AbstractBaseVueModel
{
    /** @var string|null */
    public $totalWeight;

    /** @var string|null */
    public $bodyFatPercent;

    /** @var string|null */
    public $bodyMassIndex;

    /** @var string */
    public $createdDate;
}