<?php

namespace App\Support\Factory;

use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory as Faker;
use Faker\Generator;

abstract class AbstractFactory implements FactoryInterface
{
    protected Generator $faker;
    protected Counter $counter;

    public function __construct(
        readonly protected string $entity,
        readonly protected EntityManagerInterface $entityManager
    ) {
        $this->faker = Faker::create();
        $this->counter = new Counter(count: 0);
    }

    protected function factory(string $entity): FactoryInterface
    {
        return (new Initiator(
            $this->entityManager
        ))->initiate($entity);
    }

    abstract protected function initiate(): array;

    /**
     * Determine how many instances of
     * the entity must be created.
     *
     * @param int $count count
     *
     * @return $this
     */
    public function setCount(int $count): static
    {
        $this->counter->setCount($count);

        return $this;
    }

    /**
     * Creates an instance of required entity.
     *
     * @param array $fields  fields
     * @param mixed ...$rest Fields that are passed as args.
     */
    public function create(
        array $fields = [],
        mixed ...$rest
    ): array|object {
        return $this->counter->count(
            fn () => $this->createEntity(
                $this->initiated(
                    array_merge(
                        $this->initiate(),
                        $fields,
                        $rest
                    )
                )
            )
        );
    }

    /**
     * This hook will trigger after client
     * passes its fields and the passed once
     * got merge with default once.
     *
     * @param array $fields fields
     */
    protected function initiated(array $fields): array
    {
        return $fields;
    }

    protected function createEntity(array $fields): object
    {
        $instance = new $this->entity();

        foreach ($fields as $field => $value) {
            $instance->{'set'.ucfirst($field)}($value);
        }
        $this->entityManager->persist($instance);

        try {
            $this->entityManager->flush();
        } catch (\Throwable $e) {
            dd($e, $instance);
        }

        return $instance;
    }
}
