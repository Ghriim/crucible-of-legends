<?php

namespace App\Domain\Vue\Model\PublicApi\User;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class UserGetCurrentVueModel extends AbstractBaseVueModel
{
    /** @var string */
    public $email;
}