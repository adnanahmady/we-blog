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
    public function post_fields_should_be_in_snake_case(): void
    {
        $response = $this->request();

        array_map(
            fn ($post) => $this->assertArrayHasKeys([
                'id',
                'title',
                'slug',
                'body',
                'image',
                'published_at',
                'author_id',
                'created_at',
                'updated_at',
            ], $post),
            $response->toArray()['data']
        );
    }

    /** @test */
    public function user_can_get_posts(): void
    {
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

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory(Post::class)
            ->setCount(2)
            ->create();
    }
}
