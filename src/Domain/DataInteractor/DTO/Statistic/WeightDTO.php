<?php

namespace App\Domain\DataInteractor\DTO\Statistic;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\TimeAwareDTOTrait;
use App\Domain\DataInteractor\DTO\User\UserDTO;

class WeightDTO extends AbstractBaseDTO
{
    use TimeAwareDTOTrait;

    /** @var float in grammes */
    private $totalWeight;

    /** @var float|null */
    private $bodyMassIndex;

    /** @var float|null in percent */
    private $bodyFatPercent;

    /** @var UserDTO */
    private $user;

    protected function getDefaultStatus(): string
    {
        return self::STATUS_ACTIVE;
    }

    public function getTotalWeight(): float
    {
        return $this->totalWeight;
    }

    public function setTotalWeight(float $totalWeight): void
    {
        $this->totalWeight = $totalWeight;
    }

    public function getBodyMassIndex(): ?float
    {
        return $this->bodyMassIndex;
    }

    public function setBodyMassIndex(?float $bodyMassIndex): void
    {
        $this->bodyMassIndex = $bodyMassIndex;
    }

    public function getBodyFatPercent(): ?float
    {
        return $this->bodyFatPercent;
    }

    public function setBodyFatPercent(?float $bodyFatPercent): void
    {
        $this->bodyFatPercent = $bodyFatPercent;
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