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

    protected function addCriterionIsDefault(QueryBuilder $queryBuilder, bool $isDefault): bool
    {
        return $this->addCriterion($queryBuilder, $this->getAlias(), 'isDefault', $isDefault);
    }

    protected function addSelectEntries(QueryBuilder $queryBuilder): void
    {
        $this->addSelect($queryBuilder, $this->getAlias(), 'entries', 'agenda_entry');
    }

    public function getAlias(): string
    {
        return 'agenda';
    }
}