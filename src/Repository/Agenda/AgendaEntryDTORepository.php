<?php

namespace App\Repository\Agenda;

use App\Repository\AbstractBaseEntityRepository;

final class AgendaEntryDTORepository extends AbstractBaseEntityRepository
{
    public function getAlias(): string
    {
        return 'agenda_entry';
    }
}