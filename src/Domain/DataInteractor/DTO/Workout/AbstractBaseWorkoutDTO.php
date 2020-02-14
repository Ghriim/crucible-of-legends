<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\PersistentCollection;

abstract class AbstractBaseWorkoutDTO extends AbstractBaseDTO
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $canonicalName;

    /** @var PersistentCollection|ReferenceEquipmentDTO[] */
    protected $equipments;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCanonicalName(): string
    {
        return $this->canonicalName;
    }

    public function setCanonicalName(string $canonicalName): void
    {
        $this->canonicalName = $canonicalName;
    }

    /**
     * @return ReferenceEquipmentDTO[]
     */
    public function getEquipments(): array
    {
        if ($this->equipments instanceof Collection) {
            $this->lazyLoadProtect($this->equipments);

            return $this->equipments->toArray();
        }

        return $this->equipments;
    }

    /**
     * @param ReferenceEquipmentDTO[] $equipments
     */
    public function setEquipments(array $equipments): void
    {
        $this->equipments = $equipments;
    }
}