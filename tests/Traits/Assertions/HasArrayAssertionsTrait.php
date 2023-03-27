<?php

namespace App\Tests\Traits\Assertions;

trait HasArrayAssertionsTrait
{
    protected function assertArrayHasKeys(
        array $keys,
        array $array,
        string $message = ''
    ): void {
        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $array, $message);
        }
    }
}
