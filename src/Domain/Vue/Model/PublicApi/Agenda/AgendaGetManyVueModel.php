<?php

namespace App\Domain\Vue\Model\PublicApi\Agenda;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class AgendaGetManyVueModel extends AbstractBaseVueModel
{
    /** @var string */
    public $name;

    /** @var AgendaGetManyEntryVueModel[] */
    public $entries;
}