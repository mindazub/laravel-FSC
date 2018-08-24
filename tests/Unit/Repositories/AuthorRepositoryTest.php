<?php

/*
 * mindazub
 */

declare(strict_types = 1);

namespace Tests\Unit\Repositories;

use App\Repositories\AuthorRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class AuthorRepositoryTest
 * @package Tests\Unit\Repositories
 */
class AuthorRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_singleton_instance(): void
    {
        $this->assertInstanceOf(AuthorRepository::class, $this->getTestClassInstance());
        $this->assertSame($this->getTestClassInstance(), $this->getTestClassInstance());
    }

    /**
     * @return AuthorRepository
     */
    private function getTestClassInstance(): AuthorRepository
    {
        return $this->app->make(AuthorRepository::class);
    }
}