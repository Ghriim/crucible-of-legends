<?php

namespace App\Domain\Vue\Presenter\PublicApi\User;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Model\PublicApi\User\UserGetCurrentVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\SingleObjectVuePresenterInterface;

final class UserGetCurrentVuePresenter extends AbstractVuePresenter implements SingleObjectVuePresenterInterface
{
    /**
     * @param UserDTO $dto
     *
     * @return UserGetCurrentVueModel
     */
    public function buildSingleObjectVueModel(AbstractBaseDTO $dto): AbstractBaseVueModel
    {
        $model = new UserGetCurrentVueModel();
        $model->id = $dto->getId();
        $model->email = $dto->getEmail();

        return $model;
    }

}