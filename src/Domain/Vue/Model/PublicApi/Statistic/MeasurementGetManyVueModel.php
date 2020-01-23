<?php

namespace App\Domain\Vue\Model\PublicApi\Statistic;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class MeasurementGetManyVueModel extends AbstractBaseVueModel
{
    /** @var string|null */
    public $biceps;

    /** @var string|null */
    public $chest;

    /** @var string|null */
    public $waist;

    /** @var string|null */
    public $thigh;

    /** @var string */
    public $createdDate;
}