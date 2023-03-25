<?php

namespace App\Tests\Traits;

trait MigrateDatabaseTrait
{
    use CommandExecutionerTrait;

    public function setUpMigrateDatabase(): void
    {
        $this->recreateDatabase();
        $this->executeCommand('doctrine:migrations:migrate');
    }

    public function tearDownMigrateDatabase(): void
    {
        $this->executeCommand('doctrine:migrations:rollup');
    }

    private function recreateDatabase(): void
    {
        $this->executeCommand('doctrine:database:drop', [
            '--force' => true,
        ]);
        $this->executeCommand('doctrine:database:create');
    }
}
