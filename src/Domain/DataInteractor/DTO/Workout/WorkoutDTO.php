<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\User\UserDTO;
use \DateTimeInterface;
use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\TimeAwareDTOTrait;
use App\Infrastructure\Adapter\DatabaseCollectionAdapter;

class WorkoutDTO extends AbstractBaseDTO
{
    use TimeAwareDTOTrait;

    private string $name;
    private string $canonicalName;
    private bool $isReference = false;

    private ?DateTimeInterface $programmedDate;
    private ?DateTimeInterface $completedDate;

    private UserDTO $createdByUser;
    private ?UserDTO $programmedForUser;

    /**
     * @var ExerciseDTO[]
     */
    private $exercises = [];

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

    public function isReference(): bool
    {
        return $this->isReference;
    }

    public function setIsReference(bool $isReference): void
    {
        $this->isReference = $isReference;
    }

    public function getProgrammedDate(): ?DateTimeInterface
    {
        return $this->programmedDate;
    }

    public function setProgrammedDate(?DateTimeInterface $programmedDate): void
    {
        $this->programmedDate = $programmedDate;
    }

    public function getCompletedDate(): ?DateTimeInterface
    {
        return $this->completedDate;
    }

    public function setCompletedDate(?DateTimeInterface $completedDate): void
    {
        $this->completedDate = $completedDate;
    }

    public function getCreatedByUser(): UserDTO
    {
        return $this->createdByUser;
    }

    public function setCreatedByUser(UserDTO $createdByUser): void
    {
        $this->createdByUser = $createdByUser;
    }

    public function getProgrammedForUser(): ?UserDTO
    {
        return $this->programmedForUser;
    }

    public function setProgrammedForUser(?UserDTO $programmedForUser): void
    {
        $this->programmedForUser = $programmedForUser;
    }

    public function getExercises(): array
    {
        return DatabaseCollectionAdapter::getDatabaseCollection($this->exercises);
    }

    /**
     * @param ExerciseDTO[] $exercises
     */
    public function setExercises(array $exercises): void
    {
        $this->exercises = $exercises;
    }
}