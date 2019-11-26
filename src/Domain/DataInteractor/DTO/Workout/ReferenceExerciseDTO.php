<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;

final class ReferenceExerciseDTO extends AbstractBaseDTO
{
    /** @var string */
    private $name;

    /** @var string|null */
    private $videoLink;

    /** @var PersistentCollection|ReferenceEquipmentDTO[] */
    private $referenceEquipments;

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

    public function getVideoLink(): ?string
    {
        return $this->videoLink;
    }

    public function setVideoLink(?string $videoLink): void
    {
        $this->videoLink = $videoLink;
    }

    /**
     * @return ReferenceEquipmentDTO[]
     */
    public function getReferenceEquipments():array
    {
        if ($this->referenceEquipments instanceof Collection) {
            $this->lazyLoadProtect($this->referenceEquipments);

            return $this->referenceEquipments->toArray();
        }

        return $this->referenceEquipments;
    }

    /**
     * @param ReferenceEquipmentDTO[]
     */
    public function setReferenceEquipments(array $referenceEquipments): void
    {
        $this->referenceEquipments = $referenceEquipments;
    }
}