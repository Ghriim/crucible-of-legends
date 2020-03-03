<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;

abstract class AbstractReferenceEquipmentDTO extends AbstractBaseDTO
{
    /** @var string */
    protected $name;

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
}