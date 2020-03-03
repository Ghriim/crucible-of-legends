<?php

namespace App\Domain\DataInteractor\DTO\Favorite;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\TimeAwareDTOTrait;
use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;

class FavoriteWorkout extends AbstractBaseDTO
{
    use TimeAwareDTOTrait;

    /** @var UserDTO */
    private $user;

    /** @var WorkoutDTO */
    private $workout;

    protected function getDefaultStatus(): string
    {
        return self::STATUS_ACTIVE;
    }

    public function getUser(): UserDTO
    {
        return $this->user;
    }

    public function setUser(UserDTO $user): void
    {
        $this->user = $user;
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