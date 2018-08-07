<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Article;
use App\Author;
use App\Category;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    public function __construct(
        ArticleRepository $articleRepository,
        CategoryRepository $categoryRepository,
        AuthorRepository $authorRepository
    )
    {
        $this->middleware('auth');
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->authorRepository = $authorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        /** @var LengthAwarePaginator $articles */
        $articles = Article::paginate();

        return view('article.list', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        /** @var Collection $categories */
//        $categories = Category::all();
        $categories = $this->categoryRepository->all();

        /** @var Collection $authors */
//        $authors = Author::all();
        $authors = $this->authorRepository->all();

        return view('article.create', compact('authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ArticleStoreRequest $request): RedirectResponse
    {
        $data = [
            'title' => $request->getTitle(),
            'description' => $request->getDescription(),
            'author_id' => $request->getAuthorId(),
            'slug' => $request->getSlug(),
        ];

//        $article = Article::create($data);
        $article = $this->articleRepository->create($data);

        $article->categories()->attach($request->getCategoriesIds());

        return redirect()
            ->route('article.index')
            ->with('status', 'Article created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article $article
     * @return View
     */
//    public function show(Article $article): View
    public function show(int $articleId): View
    {

        $article = $this->articleRepository->find($articleId);

        return view('article.view', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article $article
     * @return View
     */
    public function edit(Article $article): View
    {
        $authors = $this->authorRepository->all();
        $categories = $this->categoryRepository->all();

        return view('article.edit', compact('article', 'authors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleUpdateRequest $request
     * @param int $articleId
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(ArticleUpdateRequest $request, int $articleId): RedirectResponse
    {

        $this->articleRepository->update([
            'title' => $request->getTitle(),
            'description' => $request->getDescription(),
            'author_id' => $request->getAuthorId(),
            'slug' => $request->getSlug(),

        ], $articleId);

        /** @var Article $article */
        $article = $this->articleRepository->find($articleId);

        $article->categories()->sync($request->getCategoriesIds());


        return redirect()
            ->route('article.index')
            ->with('status', 'Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $articleId
     * @return RedirectResponse
     */
    public function destroy(int $articleId): RedirectResponse
    {


        try {
            $this->articleRepository->delete(['id' => $articleId]);
            return redirect()
                ->route('article.index')
                ->with('status', 'Article delete successfully!');

        } catch (\Throwable $exception) {
            return redirect()
                ->route('article.index')
                ->with('status', $exception->getMessage());
        }

    }
}
