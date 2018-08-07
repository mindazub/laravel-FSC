<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;


    /**
     * CategoryController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws \Exception
     */
    public function index(): View
    {
        $categories = $this->categoryRepository->paginate();

        return view('category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $this->categoryRepository->create([
            'title' => $request->getTitle(),
            'slug' => $request->getSlug(),
        ]);

        return redirect()
            ->route('category.index')
            ->with('status', 'Category created successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('category.edit', compact('category'));
    }

    /**
     * @param CategoryUpdateRequest $request
     * @param int $categoryId
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(CategoryUpdateRequest $request, int $categoryId): RedirectResponse
    {
        $this->categoryRepository->update([
            'title' => $request->getTitle(),
            'slug' => $request->getSlug()

        ], $categoryId);

        return redirect()
            ->route('category.index')
            ->with('status', 'Category updated successfully!');
    }

}
