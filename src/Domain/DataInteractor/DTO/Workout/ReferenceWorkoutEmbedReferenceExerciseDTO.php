<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;

class ReferenceWorkoutEmbedReferenceExerciseDTO extends AbstractReferenceExerciseDTO
{
    /** @var int */
    private $order;

    public function getOrder(): int
    {
        return $this->order;
    }

    public function setOrder(int $order): void
    {
        $this->order = $order;
    }
}