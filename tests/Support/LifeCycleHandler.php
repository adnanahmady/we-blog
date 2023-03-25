<?php

namespace App\Tests\Support;

use App\Support\Reflectors\TraitMethodCatcher;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LifeCycleHandler
{
    private TraitMethodCatcher $catcher;

    public function __construct(
        readonly private KernelTestCase $testCase
    ) {
        $this->catcher = new TraitMethodCatcher($this->testCase);
    }

    public function setUpTraits(): void
    {
        $this->catcher->execute(
            'setUp',
            fn ($method) => $this->testCase->$method()
        );
    }

    public function tearDownTraits(): void
    {
        $this->catcher->execute(
            'tearDown',
            fn ($method) => $this->testCase->$method()
        );
    }
}
