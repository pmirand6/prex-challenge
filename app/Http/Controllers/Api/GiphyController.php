<?php

namespace App\Http\Controllers\Api;

use App\Dtos\Giphy\SearchGifRequestDto;
use App\Dtos\Giphy\SearchGifResponseDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Giphy\SearchByKeywordRequest;
use App\Services\GiphyService;
use Exception;

class GiphyController extends Controller
{
    public function __construct(private readonly GiphyService $giphyService)
    {
    }
    
    /**
     * @throws Exception
     */
    public function search(SearchByKeywordRequest $query): SearchGifResponseDto
    {
        try {
            $searchGifRequest = SearchGifRequestDto::from($query->validated());
            return $this->giphyService->getGifByKeyword($searchGifRequest);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
        
    }
}
