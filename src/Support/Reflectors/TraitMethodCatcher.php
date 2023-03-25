<?php

namespace App\Support\Reflectors;

class TraitMethodCatcher
{
    private \ReflectionClass $reflection;

    public function __construct(
        object|string $objectOrClass
    ) {
        $this->reflection = new \ReflectionClass(
            $objectOrClass
        );
    }

    public function execute(string $pattern, callable $handler): void
    {
        array_map(
            $handler,
            $this->removeTraitsWithoutPattern(
                $this->findMethods($pattern)
            )
        );
    }

    private function findMethods(string $pattern): array
    {
        return array_map(
            fn ($trait) => $this->getMethodsNames(
                $trait,
                $pattern
            ),
            $this->reflection->getTraits()
        );
    }

    private function getMethodsNames(
        \ReflectionClass $trait,
        string $pattern
    ): string|null {
        $method = current(
            array_filter(
                $trait->getMethods(),
                fn ($method) => str_contains(
                    $method->name,
                    $pattern
                )
            )
        );

        return $method ? $method->name : null;
    }

    private function removeTraitsWithoutPattern(array $names): array
    {
        return array_filter($names, fn ($name) => $name);
    }
}
