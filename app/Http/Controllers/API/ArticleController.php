<?php

declare(strict_types = 1);


namespace App\Http\Controllers\API;
use App\Article;
use App\Exceptions\ArticleException;
use \Exception;
use App\Services\API\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\JsonResource;


class ArticleController extends Controller
{
    private $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function getPaginate(Request $request): JsonResponse
    {

        try{

            $articles = $this->articleService->getPaginateData((int)$request->page);
            return response()->json([
                'data'=> $articles->getCollection(),
                'status'=>true,
                'current_page'=>$articles->currentPage(),
                'total_page'=>$articles->lastPage()
            ]);
        }catch (ArticleException $exception) {

            logger($exception->getMessage(), [
                'trace' => $exception->getTrace(),
                    'message'=>$exception->getMessage(),
                    'code' => $exception->getCode(),
                    'page'=> $request->page,
                    'url' => $request->url()
            ]
        );

            return response()->json([
                'status' => false,
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
], JsonResponse::HTTP_NOT_FOUND);
        }catch(Throwable $exception)
        {
            return response()->json([
            'status'=> false,
            'message'=> 'Something wrong',
            'code' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
        ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }


    }
}
