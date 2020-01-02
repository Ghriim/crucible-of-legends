<?php

namespace App\Domain\Vue\Model\PublicApi\User;

use App\Domain\Vue\Model\AbstractBaseVueModel;

final class UserRegistrationVueModel extends AbstractBaseVueModel
{
    /** @var string */
    public $username;

    /** @var string */
    public $email;
}