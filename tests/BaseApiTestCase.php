<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Tests\Support\LifeCycleHandler;
use App\Tests\Traits\Assertions\HasArrayAssertionsTrait;

class BaseApiTestCase extends ApiTestCase
{
    use HasArrayAssertionsTrait;

    private LifeCycleHandler $cycleHandler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cycleHandler = new LifeCycleHandler($this);
        $this->cycleHandler->setUpTraits();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->cycleHandler->tearDownTraits();
    }
}
