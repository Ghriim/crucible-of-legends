<?php

namespace App\Domain\DataInteractor\DTO;

trait TimeAwareDTOTrait
{
    /** @var \DateTimeInterface */
    protected $createdDate;

    /** @var \DateTimeInterface */
    protected $updatedDate;

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
}