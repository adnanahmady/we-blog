<?php

namespace App\Tests\Traits;

trait MigrateDatabaseTrait
{
    use CommandExecutionerTrait;

    public function setUpMigrateDatabase(): void
    {
        $this->createDatabase();
        $this->migrateMigrations();
    }

    public function tearDownMigrateDatabase(): void
    {
        $this->dropDatabase();
    }

    private function dropDatabase(): void
    {
        $this->executeCommand('doctrine:database:drop', [
            '--force' => true,
        ]);
    }

    private function createDatabase(): void
    {
        $this->executeCommand('doctrine:database:create');
    }

    private function migrateMigrations(): void
    {
        $this->executeCommand('doctrine:migrations:migrate');
    }
}
