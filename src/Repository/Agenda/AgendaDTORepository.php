<?php

namespace App\Repository\Agenda;

use App\Repository\AbstractBaseEntityRepository;
use Doctrine\ORM\QueryBuilder;

final class AgendaDTORepository extends AbstractBaseEntityRepository
{
    /**
     * @param int|int[]|null $id
     */
    protected function addCriterionPlayer(QueryBuilder $queryBuilder, $id): bool
    {
        return $this->addCriterion($queryBuilder, $this->getAlias(), 'player', $id);
    }

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