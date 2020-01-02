<?php

namespace App\Domain\Vue\Presenter\PublicApi\User;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Model\PublicApi\User\UserRegistrationVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\SingleObjectVuePresenterInterface;

final class UserRegistrationVuePresenter extends AbstractVuePresenter implements SingleObjectVuePresenterInterface
{
    /**
     * @param UserDTO $dto
     *
     * @return UserRegistrationVueModel
     */
    public function buildSingleObjectVueModel(AbstractBaseDTO $dto): AbstractBaseVueModel
    {
        $model = new UserRegistrationVueModel();
        $model->id = $dto->getId();
        $model->username = $dto->getUsername();
        $model->email = $dto->getEmail();

        return $model;
    }
}