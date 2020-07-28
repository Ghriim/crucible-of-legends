<?php

namespace App\Infrastructure\Adapter;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\MongoDBException;

final class DatabaseAdapter
{
    private DocumentManager $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function createQueryBuilder(string $dtoName): QueryBuilderAdapter
    {
        return new QueryBuilderAdapter($this->documentManager->createQueryBuilder($dtoName));
    }

    public function flush(): void
    {
        try {
            $this->documentManager->flush();
        } catch (MongoDBException $exception) {
            // TODO: do something with exception. Log ?
        }
    }

    public function persist(AbstractBaseDTO $dto): void
    {
        $this->documentManager->persist($dto);
    }
}