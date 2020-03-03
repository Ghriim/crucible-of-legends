<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\TimeAwareDTOTrait;

class ReferenceEquipmentDTO extends AbstractReferenceEquipmentDTO
{
    use TimeAwareDTOTrait;

    /** @var string|null */
    protected $amazonLink;

    public function getAmazonLink(): ?string
    {
        return $this->amazonLink;
    }

    public function setAmazonLink(?string $amazonLink): void
    {
        $this->amazonLink = $amazonLink;
    }
}