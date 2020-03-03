<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\TimeAwareDTOTrait;

class CategoryDTO extends AbstractBaseDTO
{
    use TimeAwareDTOTrait;

    /** @var string */
    private $title;

    protected function getDefaultStatus(): string
    {
        return self::STATUS_ACTIVE;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}