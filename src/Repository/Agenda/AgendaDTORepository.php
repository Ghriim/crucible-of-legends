<?php

namespace App\Repository\Agenda;

use App\Repository\AbstractBaseEntityRepository;
use Doctrine\ORM\QueryBuilder;

final class AgendaDTORepository extends AbstractBaseEntityRepository
{

    protected function addSelectEntries(QueryBuilder $queryBuilder): void
    {
        $queryBuilder->leftJoin($this->getAlias() . '.entries', 'agenda_entry')
                     ->addSelect('agenda_entry')
                     ->leftJoin('agenda_entry.workout', 'agenda_entry_workout')
                     ->addSelect('agenda_entry_workout');
    }

    public function getAlias(): string
    {
        return 'agenda';
    }
}