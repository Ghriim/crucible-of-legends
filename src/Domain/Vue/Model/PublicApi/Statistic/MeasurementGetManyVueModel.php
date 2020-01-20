<?php

namespace App\Domain\Vue\Model\PublicApi\Statistic;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class MeasurementGetManyVueModel extends AbstractBaseVueModel
{
    /** @var int|null */
    public $biceps;

    /** @var int|null */
    public $chest;

    /** @var int|null */
    public $waist;

    /** @var int|null */
    public $thigh;

    /** @var string */
    public $createdDate;
}