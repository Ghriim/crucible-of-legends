<?php

namespace App\Domain\DataInteractor\DTO;

abstract class AbstractBaseDTO
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_DRAFT = 'draft';
    public const STATUS_DELETED = 'deleted';

    /** @var int|null */
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

    public function getId(): ?int
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