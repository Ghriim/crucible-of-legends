<?php

namespace App\Domain\UseCase\PublicApi\Workout;

use App\Domain\DataInteractor\DTOProvider\Workout\ReferenceExerciseDTOProvider;
use App\Domain\UseCase\AbstractUseCase;
use App\Domain\UseCase\GetManyUseCaseInterface;
use App\Domain\Vue\Presenter\PublicApi\Workout\ReferenceExerciseGetManyVuePresenter;

final class ReferenceExerciseGetManyApiUseCase extends AbstractUseCase implements GetManyUseCaseInterface
{
    private $referenceExerciseDtoProvider;
    private $presenter;

    public function __construct(ReferenceExerciseDTOProvider $referenceExerciseDtoProvider, ReferenceExerciseGetManyVuePresenter $presenter)
    {
        $this->referenceExerciseDtoProvider = $referenceExerciseDtoProvider;
        $this->presenter = $presenter;
    }

    /**
     * @return array
     */
    public function execute(array $parameters = []): array
    {
        $referenceExercises = $this->referenceExerciseDtoProvider->loadForGetMany(
            $this->buildSearchParameters($parameters)
        );

        return $this->presenter->buildMultipleObjectVueModel($referenceExercises);
    }

    private function buildSearchParameters(array $parameters): array
    {
        $searchParams = [];
        foreach ($parameters as $key => $value) {
            if (in_array($key, ['nameLike'])) {
                $searchParams['nameLike'] = $value;
            }
        }

        return $searchParams;
    }
}