<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Author;
use App\Http\Requests\AuthorRequest;
use App\Repositories\AuthorRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class AuthorController
 * @package App\Http\Controllers
 */
class AuthorController extends Controller
{

    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * AuthorController constructor.
     * @param AuthorRepository $authorRepository
     */
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {

        $authors = $this->authorRepository->paginate();

        return view('author.list', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AuthorRequest $request
     * @return RedirectResponse
     */
    public function store(AuthorRequest $request): RedirectResponse
    {

        $this->authorRepository->create([
            'first_name' => $request->getFirstName(),
            'last_name' => $request->getLastName(),
        ]);

        return redirect()
            ->route('author.index')
            ->with('status', 'Author created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author $author
     * @return View
     */
    public function edit(int $authorId): View
    {

        $author = $this->authorRepository->find($authorId);

        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AuthorRequest $request
     * @param int $authorId
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(AuthorRequest $request, int $authorId): RedirectResponse
    {
        $this->authorRepository->update([
            'first_name' => $request->getFirstName(),
            'last_name' => $request->getLastName(),
        ], $authorId);

        return redirect()
            ->route('author.index')
            ->with('status', 'Author update successfully!');
    }

}
