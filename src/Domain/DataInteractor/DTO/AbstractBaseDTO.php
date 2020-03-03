<?php

namespace App\Domain\DataInteractor\DTO;

use App\Domain\Exception\LazyLoadException;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;

abstract class AbstractBaseDTO
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_DRAFT = 'draft';
    public const STATUS_DELETED = 'deleted';

    protected $id;

    /** @var string */
    protected $status;

    abstract protected function getDefaultStatus(): string;

    public function __construct()
    {
        $this->setStatus($this->getDefaultStatus());
    }

    /**
     * @deprecated use DatabaseCollectionAdapter
     *
     * @param Collection|null $entities
     */
    protected function lazyLoadProtect(?Collection $entities): void
    {
        if ($entities instanceof PersistentCollection && false === $entities->isInitialized()) {
            $lazyLoadedClass = $entities->getTypeClass()->getName();

            throw new LazyLoadException($lazyLoadedClass);
        }
    }

    public function isNew(): bool
    {
        return null === $this->getId();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}