<?php

namespace App\Factories;

use App\Entity\User;
use App\Support\Factory\AbstractFactory;

class PostFactory extends AbstractFactory
{
    protected function initiate(): array
    {
        return [
            'title' => $this->faker->title(),
            'slug' => $this->faker->slug(),
            'body' => $this->faker->text(),
            'authorId' => $this->createAuthor()->getId(),
            'createdAt' => $this->faker->dateTime(),
        ];
    }

    private function createAuthor(): User
    {
        return $this->factory(User::class)->create();
    }
}
