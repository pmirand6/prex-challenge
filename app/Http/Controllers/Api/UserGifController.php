<?php

namespace App\Http\Controllers\Api;

use App\Dtos\UserGifs\StoreUserGifDto;
use App\Exceptions\UserGifServiceException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserGifs\StoreUserGifRequest;
use App\Services\UserGifService;
use Illuminate\Http\JsonResponse;

class UserGifController extends Controller
{
    public function __construct(private readonly UserGifService $userGifService)
    {
    }
    
    
    public function store(StoreUserGifRequest $request): JsonResponse
    {
        try {
            $mappingRequestFields = [
                'gifId' => $request->get('gif_id'),
                'userId' => $request->get('user_id'),
                'alias' => $request->get('alias'),
            ];
            $dto = StoreUserGifDto::from($mappingRequestFields);
            $result = $this->userGifService->storeFavoriteGif($dto);
            return response()->json(['message' => 'Your favorite gif has been saved'], 201);
        } catch (UserGifServiceException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
        
    }
}
