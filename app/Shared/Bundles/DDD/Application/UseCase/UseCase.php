<?php
namespace App\Shared\Bundles\DDD\Application\UseCase;

use DB;
use App\Shared\Bundles\DDD\Application\Dto;
use App\Shared\Bundles\DDD\Application\Factory\ActorFactory;
use App\Shared\Bundles\DDD\Application\Policy\UseCasePolicy;
use App\Shared\Bundles\DDD\Application\Exception\UseCasePolicyException;
use App\Shared\Bundles\DDD\Application\Policy\Notification\UseCasePolicyNotifications;

/**
 * @template T of Dto
 */
abstract readonly class UseCase
{
    public function __construct(
        // private TransactionalUseCaseService $transactionalUseCaseService
        private iterable $policies = [],
        private ActorFactory $actorFactory
    ) {

    }
    /**
     * Summary of __invoke
     * @param T $dto
     * @return void
     */
    public function __invoke(Dto $dto): void
    {
        $this->validatePolicies($dto);
        DB::transaction(fn() => $this->handle($dto));

        // ogarnac to inaczej, moze fasada w warstiwe plikacji

        // $this->transactionalUseCaseService->handleInPersistenceTransaction(fn() => $this->handle($dto));
    }

    /**
     * 
     * @throws UseCasePolicyException
     * @return void
     */
    private function validatePolicies(Dto $dto): void
    {
        $actor = $this->actorFactory->create($this->actorClass());
        $notifications = UseCasePolicyNotifications::empty();

        foreach (collect($this->policies) as $policy) {
            $notifications = $notifications->merge(
                $policy->isSatisfiedBy($actor, $dto)
            );
        }

        $notifications->validate();
    }

    /**
     * Summary of handle
     * @param T $dto
     * @return void
     */
    abstract protected function handle(Dto $dto): void;

    abstract protected function actorClass(): string;
}