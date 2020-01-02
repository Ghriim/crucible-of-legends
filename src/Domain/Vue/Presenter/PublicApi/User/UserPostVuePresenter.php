<?php

namespace App\Domain\Vue\Presenter\PublicApi\User;

use App\Domain\DataInteractor\DTO\AbstractBaseDTO;
use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Model\PublicApi\User\UserPostVueModel;
use App\Domain\Vue\Presenter\AbstractVuePresenter;
use App\Domain\Vue\Presenter\SingleObjectVuePresenterInterface;

final class UserPostVuePresenter extends AbstractVuePresenter implements SingleObjectVuePresenterInterface
{
    /**
     * @param UserDTO $dto
     *
     * @return UserPostVueModel
     */
    public function buildSingleObjectVueModel(AbstractBaseDTO $dto): AbstractBaseVueModel
    {
        $model = new UserPostVueModel();
        $model->id = $dto->getId();
        $model->username = $dto->getUsername();
        $model->email = $dto->getEmail();

        return $model;
    }
}