<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;

class ReferenceEquipmentDTO extends AbstractBaseDTO
{
    /** @var string */
    private $name;

    /** @var string|null */
    private $amazonLink;

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