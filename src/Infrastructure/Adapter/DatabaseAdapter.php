<?php

namespace App\Infrastructure\Adapter;

use Doctrine\ODM\MongoDB\DocumentManager;

final class DatabaseAdapter
{
    private $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function createQueryBuilder(string $dtoName): QueryBuilderAdapter
    {
        return new QueryBuilderAdapter($this->documentManager->createQueryBuilder($dtoName));
    }
}