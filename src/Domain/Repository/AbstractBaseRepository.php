<?php

namespace App\Domain\Repository;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Infrastructure\Adapter\DatabaseAdapter;
use App\Infrastructure\Adapter\QueryBuilderAdapter;

abstract class AbstractBaseRepository implements RepositoryInterface
{
    public const ORDER_DIRECTION_ASC  = 'ASC';
    public const ORDER_DIRECTION_DESC = 'DESC';

    private DatabaseAdapter $databaseAdapter;

    abstract protected function getDTOClassName(): string;

    public function __construct(DatabaseAdapter $databaseAdapter)
    {
        $this->databaseAdapter = $databaseAdapter;
    }

    /**
     * @return AbstractBaseDTO[]
     */
    public function findManyByCriteria(
        array $criteria = [],
        array $selects = [],
        array $orders = [],
        ?int $limit = null,
        ?int $offset = null
    ): array
    {
        $queryBuilder = $this->databaseAdapter->createQueryBuilder($this->getDTOClassName());
        $this->addCriteria($queryBuilder, $criteria)
             ->addOrderBys($queryBuilder, $orders)
             ->addSelects($queryBuilder, $selects);


        $queryBuilder->limit($limit);

        return $queryBuilder->getMultipleResults();
    }

    /**
     * @return AbstractBaseDTO|null
     */
    public function findOneByCriteria(
        array $criteria,
        array $selects = []
    ): ?AbstractBaseDTO
    {
        $queryBuilder = $this->databaseAdapter->createQueryBuilder($this->getDTOClassName());
        $this->addCriteria($queryBuilder, $criteria)
             ->addSelects($queryBuilder, $selects);

        return $queryBuilder->getSingleResult();
    }

    public function exists(array $criteria): bool
    {
        $queryBuilder = $this->databaseAdapter->createQueryBuilder($this->getDTOClassName());
        $this->addCriteria($queryBuilder, $criteria);

        return $queryBuilder->exists();
    }

    public function flush(): void
    {
        $this->databaseAdapter->flush();
    }

    public function persist(AbstractBaseDTO $dto): void
    {
        $this->databaseAdapter->persist($dto);
    }

    protected function addCriteria(QueryBuilderAdapter $queryBuilder, array $criteria = []): self
    {
        foreach ($criteria as $field => $value) {
            if ($field) {
                $this->{'addCriterion' . ucfirst($field)}($queryBuilder, $value);
            }
        }

        return $this;
    }

    protected function addSelects(QueryBuilderAdapter $queryBuilder, array $selects = []): self
    {
        foreach ($selects as $field => $value) {
            if ($field) {
                $this->{'addSelect' . ucfirst($field)}($queryBuilder, $value);
            }
        }

        return $this;
    }

    protected function addCriterion(QueryBuilderAdapter $queryBuilder, string $fieldName, $value, bool $exclude = false): bool
    {
        if (null === $value) {
            return false;
        }

        $queryBuilder->equals($fieldName, $value);

        return true;
    }

    protected function addOrderBys(QueryBuilderAdapter $queryBuilder, array $orderBys = []): self
    {
        foreach ($orderBys as $orderBy => $direction) {
            if ($orderBy) {
                $this->{'addOrderBy' . ucfirst($orderBy)}($queryBuilder, $direction);
            }
        }

        return $this;
    }

    protected function addOrderBy(QueryBuilderAdapter $queryBuilder, $fieldName, $direction): void
    {
        if (false === in_array($direction, [self::ORDER_DIRECTION_DESC, self::ORDER_DIRECTION_ASC], true)) {
            throw new \LogicException("$direction is not a valid value for order by 'direction' parameter.");
        }

        $queryBuilder->addOrderBy($fieldName, $direction);
    }

    protected function addSelect(QueryBuilderAdapter $queryBuilder, $fieldName): void
    {
        $queryBuilder->addSelect($fieldName);
    }

    protected function addCriterionId(QueryBuilderAdapter $queryBuilder, $id): bool
    {
        return $this->addCriterion($queryBuilder, 'id', $id);
    }

    protected function addCriterionStatus(QueryBuilderAdapter $queryBuilder, $status): bool
    {
        return $this->addCriterion($queryBuilder, 'status', $status);
    }

}