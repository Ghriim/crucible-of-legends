<?php

namespace App\Domain\Vue\Model\PublicApi\Agenda;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class AgendaGetSingleVueModel extends AbstractBaseVueModel
{
    /** @var string */
    public $name;

    /** @var AgendaGetSingleEntryVueModel[] */
    public $entries;
}