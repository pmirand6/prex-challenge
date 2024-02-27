<?php

namespace App\Http\Controllers\Api;

use App\Dtos\Giphy\SearchByIdGifResponseDto;
use App\Dtos\Giphy\SearchGifRequestDto;
use App\Dtos\Giphy\SearchGifResponseDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Giphy\SearchByKeywordRequest;
use App\Services\GiphyService;
use Exception;
use Illuminate\Http\JsonResponse;

class GiphyController extends Controller
{
    public function __construct(private readonly GiphyService $giphyService)
    {
        $this->middleware('audit-trail');
    }
    
    /**
     * @throws Exception
     */
    public function search(SearchByKeywordRequest $query): SearchGifResponseDto|JsonResponse
    {
        try {
            $searchGifRequest = SearchGifRequestDto::from($query->validated());
            return $this->giphyService->getGifByKeyword($searchGifRequest);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
        
    }
    
    /**
     * @throws Exception
     */
    public function findById(string $id): SearchByIdGifResponseDto|JsonResponse
    {
        try {
            return $this->giphyService->getGifById($id);
        } catch (Exception $e) {
           return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
