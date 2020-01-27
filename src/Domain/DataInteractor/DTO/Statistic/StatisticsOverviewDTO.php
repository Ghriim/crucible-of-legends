<?php

namespace App\Domain\DataInteractor\DTO\Statistic;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\User\UserDTO;

class StatisticsOverviewDTO extends AbstractBaseDTO
{
    /** @var WeightDTO|null */
    private $firstWeight;

    /** @var WeightDTO|null */
    private $lastWeight;

    /** @var MeasurementDTO|null */
    private $firstMeasurement;

    /** @var MeasurementDTO|null */
    private $lastMeasurement;

    /** @var UserDTO */
    private $user;

    protected function getDefaultStatus(): string
    {
        return self::STATUS_ACTIVE;
    }

    public function getFirstWeight(): ?WeightDTO
    {
        return $this->firstWeight;
    }

    public function setFirstWeight(?WeightDTO $firstWeight): void
    {
        $this->firstWeight = $firstWeight;
    }

    public function getLastWeight(): ?WeightDTO
    {
        return $this->lastWeight;
    }

    public function setLastWeight(?WeightDTO $lastWeight): void
    {
        $this->lastWeight = $lastWeight;
    }

    public function getFirstMeasurement(): ?MeasurementDTO
    {
        return $this->firstMeasurement;
    }

    public function setFirstMeasurement(?MeasurementDTO $firstMeasurement): void
    {
        $this->firstMeasurement = $firstMeasurement;
    }

    public function getLastMeasurement(): ?MeasurementDTO
    {
        return $this->lastMeasurement;
    }

    public function setLastMeasurement(?MeasurementDTO $lastMeasurement): void
    {
        $this->lastMeasurement = $lastMeasurement;
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