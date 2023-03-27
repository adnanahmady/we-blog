<?php

namespace App\Tests\Traits;

use App\Support\Console\CommandExecutioner;

trait CommandExecutionerTrait
{
    protected function executeCommand(
        string $command,
        array $options = []
    ): void {
        $this->getExecutioner()->execute(
            $command,
            $options
        );
    }

    private function getExecutioner(): CommandExecutioner
    {
        return new CommandExecutioner(
            bootedKernel: $this->bootKernel()
        );
    }
}
