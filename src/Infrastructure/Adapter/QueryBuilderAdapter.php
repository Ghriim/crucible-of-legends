<?php

namespace App\Infrastructure\Adapter;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Query\Builder as QueryBuilder;

final class QueryBuilderAdapter
{
    private $queryBuilder;

    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function equals(string $fieldName, $value): void
    {
        $this->queryBuilder->field($fieldName)->equals($value);
    }

    public function limit(?int $limit = null): void
    {
        if (null !== $limit) {
            $this->queryBuilder->limit($limit);
        }
    }

    public function addOrderBy(string $fieldName, string $direction = 'ASC'): void
    {
        $this->queryBuilder->sort($fieldName, 'ASC' === $direction ? 0 : 1);
    }

    public function addSelect(string $fieldName): void
    {
        $this->queryBuilder->select($fieldName);
    }

    /**
     * @return AbstractBaseDTO[]
     */
    public function getMultipleResults(): array
    {
        try {
            $result = $this->queryBuilder->getQuery()->execute();

            return null === $result ? [] : $result->toArray();
        } catch (MongoDBException $exception) {
            // Todo: do something with exception;
        }

        return [];
    }

    /**
     * @return AbstractBaseDTO|null|object
     */
    public function getSingleResult(): ?AbstractBaseDTO
    {
        return $this->queryBuilder->getQuery()->getSingleResult();
    }

    /**
     * @return bool
     */
    public function exists(): ?bool
    {
        $this->queryBuilder->count();

        var_dump($this->queryBuilder->getQuery()->execute()); die;

        return 0 < $this->queryBuilder->getQuery()->execute();
    }
}