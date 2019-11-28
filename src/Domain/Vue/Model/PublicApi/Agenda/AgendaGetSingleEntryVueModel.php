<?php

namespace App\Domain\Vue\Model\PublicApi\Agenda;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class AgendaGetSingleEntryVueModel  extends AbstractBaseVueModel
{
    /** @var string */
    public $workoutName;

    /** @var string */
    public $workoutCanonicalName;

    /** @var string */
    public $programmedDate;

    /** @var string */
    public $completedDate;
}