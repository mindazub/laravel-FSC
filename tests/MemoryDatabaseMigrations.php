<?php

/*
 * mindazub
 */

declare(strict_types = 1);

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

/**
 * Trait MemoryDatabaseMigrations
 * @package Tests
 */
trait MemoryDatabaseMigrations
{
    /**
     *
     */
    public function runDatabaseMigrations(): void
    {
        $this->artisan('migrate:fresh');

        $this->app[Kernel::class]->setArtisan(null);

        $this->beforeApplicationDestroyed(function () {
            if (DB::connection()->getDatabaseName() != ':memory:') {
                $this->artisan('migrate:rollback');
            }
        });
    }
}