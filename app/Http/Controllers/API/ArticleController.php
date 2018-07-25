<?php

declare(strict_types=1);


namespace App\Http\Controllers\API;

use App\Article;
use App\Exceptions\ApiDataException;
use App\Exceptions\ArticleException;
use \Exception;
use App\Services\API\ArticleService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


/**
 * Class ArticleController
 * @package App\Http\Controllers\API
 */
class ArticleController extends Controller
{
    /**
     * @var ArticleService
     */
    private $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ApiDataException
     */
    public function getPaginate(Request $request): JsonResponse
    {

        try {

            $articles = $this->articleService->getPaginateData();


            return response()->json([
//                'data' => $articles->getCollection(),
                'status' => true,
                'data' => $articles,

//                'current_page' => $articles->currentPage(),
//                'total_page' => $articles->lastPage()
            ]);
        } catch (ArticleException $exception) {

            logger($exception->getMessage(), [
                    'trace' => $exception->getTrace(),
                    'message' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                    'page' => $request->page,
                    'url' => $request->url()
                ]
            );

            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_NOT_FOUND);
        } catch (Throwable $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }


    }

    /**
     * @param Request $request
     * @param int $articleId
     * @return JsonResponse
     */
    public function getByIdFull(Request $request, int $articleId): JsonResponse
    {
        try {

            $articleFull = $this->articleService->getByIdFull($articleId);
//dd($articleFull);

                return response()->json([
                    'success' => true,
                    'data' => $articleFull,
                ]);


        } catch (\Throwable $exception) {

            return response()->json([
                'success' => false,
                'message'=> $exception->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws ApiDataException
     */
    public function getFullData(Request $request, int $id): JsonResponse
    {
        try {

            $article = $this->articleService->getFullData((int)$request->article);

//            dd($article);

            return response()->json([
                'success' => true,
                'data' => $article,
            ]);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_NOT_FOUND);
        } catch (Throwable $exception) {


            return response()->json([
                'success' => false,
                'message' => 'Something wrong ...',
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function getById(int $articleId): JsonResponse
    {


        try {

            $article = $this->articleService->getByIdForApi($articleId);

//            dd($article);

            /** @var Article $article */
            return response()->json([
                'success' => true,
                'data' => $article,

            ]);

        } catch (ModelNotFoundException $exception) {
            logger([
                $exception->getMessage(),
                'code' => $exception->getCode(),
                'author-id' => $request->id,
                'path' => $request->path(),
                'url' => $request->url(),
            ]);
            return response()->json([
                'success' => false,
                'code' => $exception->getCode(),
                'message' => 'No data found',
            ], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $exception) {
//            dd($exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }


    }
}
