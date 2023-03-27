<?php

namespace App\Support\Console;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\HttpKernel\KernelInterface;

class CommandExecutioner
{
    public function __construct(
        readonly private KernelInterface $bootedKernel
    ) {
    }

    public function execute(string $command, array $options): void
    {
        $this->executeCommand(
            $this->findCommand($command),
            $options
        );
    }

    private function findCommand(string $command): Command
    {
        $application = new Application($this->bootedKernel);

        return $application->find($command);
    }

    private function executeCommand(
        Command $command,
        array $options
    ): void {
        $tester = new CommandTester($command);
        $tester->execute($options);
    }
}
