<?php

namespace App\Domain\UseCase\PublicApi\Workout;

use App\Domain\DataInteractor\DTO\Workout\WorkoutDTO;
use App\Domain\DataInteractor\DTOPersister\Workout\WorkoutDTOPersister;
use App\Domain\DataInteractor\DTOProvider\Workout\WorkoutDTOProvider;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\PostUseCaseInterface;
use App\Domain\Vue\Model\AbstractBaseVueModel;
use App\Domain\Vue\Presenter\PublicApi\Workout\WorkoutPostVuePresenter;
use App\Tools\String\CanonicalizeString;
use App\Tools\String\RandomString;

final class WorkoutPostApiUseCaseInterface extends AbstractUseCase implements PostUseCaseInterface
{
    private $workoutDtoPersister;
    private $workoutDtoProvider;
    private $presenter;

    public function __construct(
        WorkoutDTOPersister $workoutDtoPersister,
        WorkoutDTOProvider $workoutDtoProvider,
        WorkoutPostVuePresenter $presenter
    )
    {
        $this->workoutDtoPersister = $workoutDtoPersister;
        $this->workoutDtoProvider = $workoutDtoProvider;
        $this->presenter = $presenter;
    }

    public function execute(\stdClass $jsonObject): ?AbstractBaseVueModel
    {
        $workout = new WorkoutDTO();
        $workout->setName(trim($jsonObject->name));
        $workout->setCanonicalName($this->buildCanonicalName($workout->getName()));

        $this->workoutDtoPersister->create($workout);

        return $this->presenter->buildSingleObjectVueModel($workout);
    }

    private function buildCanonicalName(string $name): string
    {
        $canonicalizedName = CanonicalizeString::canonicalize($name);

        if ($this->workoutDtoProvider->doesCanonicalNameAlreadyExist($canonicalizedName)) {
            return $canonicalizedName . '-' . RandomString::generate(5);
        }

        return $canonicalizedName;
    }
}