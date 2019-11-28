<?php

namespace App\Repository\Agenda;

use App\Repository\AbstractBaseEntityRepository;
use Doctrine\ORM\QueryBuilder;

final class AgendaEntryDTORepository extends AbstractBaseEntityRepository
{
    protected function addSelectEntries(QueryBuilder $queryBuilder): void
    {
        $queryBuilder->leftJoin($this->getAlias() . '.workout', 'agenda_entry_workout')
                     ->addSelect('agenda_entry_workout');
    }

    protected function addOrderByProgrammedDate(QueryBuilder $queryBuilder, string $direction = self::ORDER_DIRECTION_DESC): void
    {
        $this->addOrderBy($queryBuilder, $this->getAlias(), 'programmedDate', $direction);
    }

    public function getAlias(): string
    {
        return 'agenda_entry';
    }
}