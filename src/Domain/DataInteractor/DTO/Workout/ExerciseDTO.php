<?php

namespace App\Domain\DataInteractor\DTO\Workout;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;

final class ExerciseDTO extends AbstractBaseDTO
{
    /** @var string */
    private $name;

    /** @var int|null in seconds */
    private $durationProgrammed;

    /** @var int|null in seconds */
    private $durationExecuted;

    /** @var int|null */
    private $repetitionsProgrammed;

    /** @var int|null */
    private $repetitionsExecuted;

    /** @var int|null */
    private $weightProgrammed;

    /** @var int|null */
    private $weightExecuted;

    /** @var int */
    private $position;

    /** @var WorkoutDTO|null */
    private $workout;


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

    public function getDurationProgrammed(): ?int
    {
        return $this->durationProgrammed;
    }

    public function setDurationProgrammed(?int $durationProgrammed): void
    {
        $this->durationProgrammed = $durationProgrammed;
    }

    public function getDurationExecuted(): ?int
    {
        return $this->durationExecuted;
    }

    public function setDurationExecuted(?int $durationExecuted): void
    {
        $this->durationExecuted = $durationExecuted;
    }

    public function getRepetitionsProgrammed(): ?int
    {
        return $this->repetitionsProgrammed;
    }

    public function setRepetitionsProgrammed(?int $repetitionsProgrammed): void
    {
        $this->repetitionsProgrammed = $repetitionsProgrammed;
    }

    public function getRepetitionsExecuted(): ?int
    {
        return $this->repetitionsExecuted;
    }

    public function setRepetitionsExecuted(?int $repetitionsExecuted): void
    {
        $this->repetitionsExecuted = $repetitionsExecuted;
    }

    public function getWeightProgrammed(): ?int
    {
        return $this->weightProgrammed;
    }

    public function setWeightProgrammed(?int $weightProgrammed): void
    {
        $this->weightProgrammed = $weightProgrammed;
    }

    public function getWeightExecuted(): ?int
    {
        return $this->weightExecuted;
    }

    public function setWeightExecuted(?int $weightExecuted): void
    {
        $this->weightExecuted = $weightExecuted;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getWorkout(): ?WorkoutDTO
    {
        return $this->workout;
    }

    public function setWorkout(?WorkoutDTO $workout): void
    {
        $this->workout = $workout;
    }
}