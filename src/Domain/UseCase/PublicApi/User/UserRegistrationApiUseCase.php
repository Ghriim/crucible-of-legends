<?php

namespace App\Domain\UseCase\PublicApi\User;

use App\Domain\DataInteractor\DTO\User\UserDTO;
use App\Domain\DataInteractor\DTOPersister\User\UserDTOPersister;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\PostUseCaseInterface;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Presenter\PublicApi\User\UserRegistrationVuePresenter;
use App\Security\Handler\PasswordHandler;

final class UserRegistrationApiUseCase extends AbstractUseCase implements PostUseCaseInterface
{
    private $userDtoPersister;
    private $presenter;

    private $passwordHandler;

    public function __construct(
        UserDTOPersister $userDtoPersister,
        UserRegistrationVuePresenter $presenter,
        PasswordHandler $passwordHandler
    )
    {
        $this->userDtoPersister = $userDtoPersister;
        $this->presenter = $presenter;
        $this->passwordHandler = $passwordHandler;
    }

    public function execute(\stdClass $jsonObject, array $parameters = []): ?AbstractBaseVueModel
    {
        $user = new UserDTO();
        $user->setUsername(trim($jsonObject->username));
        $user->setEmail(trim($jsonObject->email));

        $password = $this->getPassword($user, trim($jsonObject->password));
        $user->setPassword($password);

        $this->userDtoPersister->create($user);

        return $this->presenter->buildSingleObjectVueModel($user);
    }

    private function getPassword(UserDTO $user, string $plainPassword): string
    {
        return $this->passwordHandler->encode($user, $plainPassword);
    }
}