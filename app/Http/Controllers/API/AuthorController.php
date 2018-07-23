<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Exceptions\AuthorException;
use App\Services\API\AuthorService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AuthorController extends Controller
{
    private $authorService;

    public function __construct(AuthorService $authorService)
    {
        return $this->authorService = $authorService;
    }



    public function getPaginate(Request $request): JsonResponse
    {

        try{

            $authors = $this->authorService->getPaginateData((int)$request->page);
            return response()->json([
                'data'=> $authors->getCollection(),
                'status'=>true,
                'current_page'=>$authors->currentPage(),
                'total_page'=>$authors->lastPage()
            ]);
        }catch (AuthorException $exception) {

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


    public function getFullData(Request $request): JsonResponse
    {
        try{

            $authors = $this->authorService->getFullData((int)$request->page);

            return response()->json([
                'success' => true,
                'data' => $authors,
            ]);

        } catch (AuthorException $exception) {
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
     *
     */
    public function getById(Request $request, int $id): JsonResponse
    {


        try {

            $author = $this->authorService->getById($id);

            return response()->json([
                'success' => true,
                'data' => $author,

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
