<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/26 19:40
 */

namespace App\Services;

use App\Dtos\Giphy\SearchGifRequestDto;
use App\Dtos\Giphy\SearchGifResponseDto;
use App\Exceptions\GiphyServiceException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GiphyService
{
    const SEARCH_GIPHY_PREFIX = 'search';
    
    /**
     * @param SearchGifRequestDto $searchGifRequest
     * @return SearchGifResponseDto
     * @throws \Exception
     */
    public function getGifByKeyword(SearchGifRequestDto $searchGifRequest): SearchGifResponseDto
    {
        try {
            $requestData = [
                'api_key' => config('giphy.api.key'),
                'q' => $searchGifRequest->keyword,
                'limit' => $searchGifRequest->limit,
                'offset' => $searchGifRequest->offset,
            ];
            
            $response = Http::get(config('giphy.api.url') . self::SEARCH_GIPHY_PREFIX, $requestData);
            
            return SearchGifResponseDto::from($response->json());
            
        } catch (\Throwable $e) {
            Log::error('Error getting gif by keyword', ['error' => $e->getMessage()]);
            throw new GiphyServiceException($e->getMessage());
        }
        
    }
}