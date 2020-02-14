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

    /** @var \DateTimeInterface */
    protected $createdDate;

    /** @var \DateTimeInterface */
    protected $updatedDate;

    /** @var string */
    protected $status;

    abstract protected function getDefaultStatus(): string;

    public function __construct()
    {
        $this->setStatus($this->getDefaultStatus());
    }

    /**
     * @param Collection|null $entities
     */
    protected function lazyLoadProtect(?Collection $entities): void
    {
        if ($entities instanceof PersistentCollection && false === $entities->isInitialized()) {
            $parentClass = get_class($this);
            $lazyLoadedClass = $entities->getTypeClass()->getName();

            throw new LazyLoadException($parentClass, $lazyLoadedClass);
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

    public function getCreatedDate(): \DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): void
    {
        $this->createdDate = $createdDate;
    }

    public function getUpdatedDate(): \DateTimeInterface
    {
        return $this->updatedDate;
    }

    public function setUpdatedDate(\DateTimeInterface $updatedDate): void
    {
        $this->updatedDate = $updatedDate;
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