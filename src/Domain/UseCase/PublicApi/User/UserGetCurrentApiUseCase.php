<?php

namespace App\Domain\UseCase\PublicApi\User;

use App\Domain\DataInteractor\DTOProvider\User\UserDTOProvider;
use App\Domain\Exception\UserShouldExistException;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\GetSingleUseCaseInterface;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Model\PublicApi\User\UserGetCurrentVueModel;
use App\Domain\Vue\Presenter\PublicApi\User\UserGetCurrentVuePresenter;

class UserGetCurrentApiUseCase extends AbstractUseCase implements GetSingleUseCaseInterface
{
    private $userDtoProvider;
    private $presenter;

    public function __construct(
        UserDTOProvider $userDtoProvider,
        UserGetCurrentVuePresenter $presenter
    )
    {
        $this->userDtoProvider = $userDtoProvider;
        $this->presenter = $presenter;
    }

    /**
     * @param int $identifier
     *
     * @return UserGetCurrentVueModel
     */
    public function execute($identifier, array $parameters): ?AbstractBaseVueModel
    {
        try {
            $user = $this->userDtoProvider->loadForGetCurrent($identifier);
        } catch (UserShouldExistException $exception) {
            return null;
        }

        return $this->presenter->buildSingleObjectVueModel($user);
    }
}