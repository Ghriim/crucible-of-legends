<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\TimeAwareDTOTrait;
use App\Infrastructure\Adapter\DatabaseCollectionAdapter;

class ExerciseDTO extends AbstractBaseDTO
{
    use TimeAwareDTOTrait;

    private string $name;
    private string $canonicalName;

    /**
     * @var EquipmentDTO[]
     */
    private $equipments = [];

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

    public function getCanonicalName(): string
    {
        return $this->canonicalName;
    }

    public function setCanonicalName(string $canonicalName): void
    {
        $this->canonicalName = $canonicalName;
    }

    public function getEquipments(): array
    {
        return DatabaseCollectionAdapter::getDatabaseCollection($this->equipments);
    }

    /**
     * @param EquipmentDTO[] $equipments
     */
    public function setEquipments(array $equipments): void
    {
        $this->equipments = $equipments;
    }
}