<?php



declare(strict_types = 1);

namespace Tests\Unit\Repositories;

use App\Category;
use App\Repositories\CategoryRepository;
use Tests\MemoryDatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class CategoryRepositoryTest
 * @package Tests\Unit\Repositories
 */
class CategoryRepositoryTest extends TestCase
{
    use MemoryDatabaseMigrations;

    /**
     * @test
     */
    public function it_should_create_singleton_instance(): void
    {
        $this->assertInstanceOf(CategoryRepository::class, $this->getTestClassInstance());
        $this->assertSame($this->getTestClassInstance(), $this->getTestClassInstance());
    }

    /**
     * @test
     * @throws \Exception
     */
    public function it_should_return_null_on_get_by_slug(): void
    {
        $slug = str_random(10);

        $result = $this->getTestClassInstance()->getBySlug($slug);

        $this->assertNull($result);
    }

    /**
     * @test
     * @throws \Exception
     */
    public function it_should_return_category_by_slug(): void
    {
        factory(Category::class)->create();

        /** @var Category $category */
        $category = factory(Category::class)->create([
            'reference_category_id' => null,
        ]);

        factory(Category::class)->create();

        $result = $this->getTestClassInstance()->getBySlug($category->slug);

        $this->assertInstanceOf(Category::class, $result);
        $this->assertEquals($category->toArray(), $result->toArray());
    }

    /**
     * @test
     * @throws \Exception
     */
    public function it_should_return_null_by_slug_and_not_id_empty_table(): void
    {
        $slug = str_random(10);
        $id = mt_rand(1, 10);

        $this->assertNull($this->getTestClassInstance()->getBySlugAndNotId($slug, $id));
    }

    /**
     * @test
     * @throws \Exception
     */
    public function it_should_return_null_by_slug_and_not_id_not_empty_table(): void
    {
        factory(Category::class)->create();

        /** @var Category $category */
        $category = factory(Category::class)->create();

        factory(Category::class)->create();

        $this->assertNull($this->getTestClassInstance()->getBySlugAndNotId($category->slug, $category->id));
    }

    /**
     * @test
     * @throws \Exception
     */
    public function it_should_return_row_by_slug_and_not_id(): void
    {
        /** @var Category $category1 */
        $category1 = factory(Category::class)->create([
            'reference_category_id' => null,
        ]);
        /** @var Category $category2 */
        $category2 = factory(Category::class)->create();

        $result = $this->getTestClassInstance()->getBySlugAndNotId($category1->slug, $category2->id);

        $this->assertInstanceOf(Category::class, $result);
        $this->assertEquals($category1->toArray(), $result->toArray());
    }

    /**
     * @return CategoryRepository
     */
    private function getTestClassInstance(): CategoryRepository
    {
        return $this->app->make(CategoryRepository::class);
    }
}