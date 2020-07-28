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

    protected  $id;
    protected string $status;

    abstract protected function getDefaultStatus(): string;

    public function __construct()
    {
        $this->setStatus($this->getDefaultStatus());
    }

    public function isNew(): bool
    {
        return null === $this->getId();
    }

    public function getId(): ?string
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