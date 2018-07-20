<?php

namespace App\Http\Controllers\API;

use App\Exceptions\ApiDataException;
use App\Exceptions\CategoryException;
use App\Services\API\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API
 */
class CategoryController extends Controller
{
    private $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        return $this->categoryService = $categoryService;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaginate(Request $request): JsonResponse
    {

        try{

            $categories = $this->categoryService->getPaginateData((int)$request->page);
            return response()->json([
                'data'=> $categories->getCollection(),
                'status'=>true,
                'current_page'=>$categories->currentPage(),
                'total_page'=>$categories->lastPage()
            ]);
        }catch (CategoryException $exception) {

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


    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function getById(Request $request, int $id): JsonResponse
    {


        try {

            $category = $this->categoryService->getById($id);

            return response()->json([
                'success' => true,
                'data' => $category,

            ]);

        } catch (ModelNotFoundException $exception)
        {
            logger([
                $exception->getMessage(),
                'code'=>$exception->getCode(),
                'author-id' => $id,
                'path' => $request->path(),
                'url' => $request->url(),
            ]);
            return response()->json([
                'success' => false,
                'code' =>  $exception->getCode(),
                'message' => 'No data found',
            ], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $exception)
        {
            return response()->json([
                'success' =>false,
                'message' =>'Something wrong',
                'code' => $exception->getCode(),
            ]);
        }



    }
}
