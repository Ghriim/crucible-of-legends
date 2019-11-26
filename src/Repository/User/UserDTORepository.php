<?php

namespace App\Repository\User;

use App\Repository\AbstractBaseEntityRepository;

final class UserDTORepository extends AbstractBaseEntityRepository
{
    public function getAlias(): string
    {
        return 'user';
    }
}