<?php

namespace App\Factories;

use App\Support\Factory\AbstractFactory;

class UserFactory extends AbstractFactory
{
    protected function initiate(): array
    {
        return [
            'firstName' => $this->faker->name(),
            'lastName' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'password' => 'secret',
            'createdAt' => $this->faker->dateTime(),
        ];
    }
}
