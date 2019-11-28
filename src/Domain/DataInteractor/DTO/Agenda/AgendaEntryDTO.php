<?php

namespace App\Domain\DataInteractor\DTO\Agenda;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;

class AgendaEntryDTO extends AbstractBaseDTO
{
    public const STATUS_PROGRAMMED = 'programmed';
    public const STATUS_OVERDUE = 'overdue';
    public const STATUS_COMPLETED = 'completed';

    /** @var \DateTimeInterface */
    private $programmedDate;

    /** @var \DateTimeInterface|null */
    private $completedDate;

    /** @var AgendaDTO */
    private $agenda;

    /** @var WorkoutDTO */
    private $workout;

    protected function getDefaultStatus(): string
    {
        return self::STATUS_PROGRAMMED;
    }

    public function getProgrammedDate(): \DateTimeInterface
    {
        return $this->programmedDate;
    }

    public function setProgrammedDate(\DateTimeInterface $programmedDate): void
    {
        $this->programmedDate = $programmedDate;
    }

    public function getCompletedDate(): ?\DateTimeInterface
    {
        return $this->completedDate;
    }

    public function setCompletedDate(?\DateTimeInterface $completedDate): void
    {
        $this->completedDate = $completedDate;
    }

    public function getAgenda(): AgendaDTO
    {
        return $this->agenda;
    }

    public function setAgenda(AgendaDTO $agenda): void
    {
        $this->agenda = $agenda;
    }

    public function getWorkout(): WorkoutDTO
    {
        return $this->workout;
    }

    public function setWorkout(WorkoutDTO $workout): void
    {
        $this->workout = $workout;
    }
}