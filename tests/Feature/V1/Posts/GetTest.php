<?php

namespace App\Tests\Feature\V1\Posts;

use App\Entity\Post;
use App\Tests\BaseApiTestCase;
use App\Tests\Traits\HasFactoryTrait;
use App\Tests\Traits\MigrateDatabaseTrait;
use Symfony\Contracts\HttpClient\ResponseInterface;

class GetTest extends BaseApiTestCase
{
    use MigrateDatabaseTrait;
    use HasFactoryTrait;

    /** @test */
    public function user_can_get_posts(): void
    {
        $this->factory(Post::class)
            ->setCount(2)
            ->create();
        $response = $this->request();

        $this->assertResponseIsSuccessful();
        $this->assertCount(2, $response->toArray()['data']);
    }

    private function request(): ResponseInterface
    {
        return static::createClient()->request(
            'GET',
            '/api/v1/posts'
        );
    }
}
