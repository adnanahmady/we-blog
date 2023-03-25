<?php

namespace App\Support\Factory;

use Doctrine\ORM\EntityManagerInterface;

class Initiator
{
    public function __construct(
        readonly private EntityManagerInterface $entityManager
    ) {
    }

    public function initiate(string $entity): FactoryInterface
    {
        $Factory = sprintf(
            'App\\Factories\\%sFactory',
            $this->getEntityName($entity)
        );

        return new $Factory($entity, $this->entityManager);
    }

    private function getEntityName(string $entity): string
    {
        return pregTrim($entity, '.*\\\\');
    }
}
