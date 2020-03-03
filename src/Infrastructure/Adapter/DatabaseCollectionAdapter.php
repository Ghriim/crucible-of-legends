<?php

namespace App\Infrastructure\Adapter;

use Doctrine\ODM\MongoDB\PersistentCollection;

final class DatabaseCollectionAdapter
{
    public static function getDatabaseCollection($items): array
    {
        if ($items instanceof PersistentCollection) {
            return $items->toArray();
        }

        return $items;
    }
}