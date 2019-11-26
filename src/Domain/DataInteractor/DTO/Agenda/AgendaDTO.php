<?php

namespace App\Domain\DataInteractor\DTO\Agenda;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\User\UserDTO;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;

class AgendaDTO extends AbstractBaseDTO
{
    private const NAME_DEFAULT = 'default';

    /** @var string */
    private $name = self::NAME_DEFAULT;

    /** @var UserDTO */
    private $user;

    /** @var PersistentCollection|AgendaEntryDTO[] */
    private $entries;

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

    public function getUser(): UserDTO
    {
        return $this->user;
    }

    public function setUser(UserDTO $user): void
    {
        $this->user = $user;
    }

    /**
     * @return AgendaEntryDTO[]
     */
    public function getEntries(): array
    {
        if ($this->entries instanceof Collection) {
            $this->lazyLoadProtect($this->entries);

            return $this->entries->toArray();
        }

        return $this->entries;
    }

    /**
     * @param AgendaEntryDTO[] $entries
     */
    public function setEntries(array $entries): void
    {
        $this->entries = $entries;
    }

}