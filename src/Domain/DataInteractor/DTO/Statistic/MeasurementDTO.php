<?php

namespace App\Domain\DataInteractor\DTO\Statistic;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\User\UserDTO;

class MeasurementDTO extends AbstractBaseDTO
{
    /** @var int|null in millimeters */
    private $biceps;

    /** @var int|null in millimeters */
    private $chest;

    /** @var int|null in millimeters */
    private $waist;

    /** @var int|null in millimeters */
    private $thigh;

    /** @var UserDTO */
    private $user;

    protected function getDefaultStatus(): string
    {
        return self::STATUS_ACTIVE;
    }

    public function getBiceps(): ?int
    {
        return $this->biceps;
    }

    public function setBiceps(?int $biceps): void
    {
        $this->biceps = $biceps;
    }

    public function getChest(): ?int
    {
        return $this->chest;
    }

    public function setChest(?int $chest): void
    {
        $this->chest = $chest;
    }

    public function getWaist(): ?int
    {
        return $this->waist;
    }

    public function setWaist(?int $waist): void
    {
        $this->waist = $waist;
    }

    public function getThigh(): ?int
    {
        return $this->thigh;
    }

    public function setThigh(?int $thigh): void
    {
        $this->thigh = $thigh;
    }

    public function getUser(): UserDTO
    {
        return $this->user;
    }

    public function setUser(UserDTO $user): void
    {
        $this->user = $user;
    }
}