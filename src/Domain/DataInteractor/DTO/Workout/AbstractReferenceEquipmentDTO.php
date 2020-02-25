<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;

abstract class AbstractReferenceEquipmentDTO extends AbstractBaseDTO
{
    /** @var string */
    protected $name;

    /** @var string|null */
    protected $amazonLink;

    protected function getDefaultStatus(): string
    {
        return self::STATUS_ACTIVE;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAmazonLink(): ?string
    {
        return $this->amazonLink;
    }

    public function setAmazonLink(?string $amazonLink): void
    {
        $this->amazonLink = $amazonLink;
    }
}