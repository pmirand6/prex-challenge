<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/26 21:53
 */

namespace App\Services;

use App\Dtos\UserGifs\StoreUserGifDto;
use App\Exceptions\UserGifServiceException;
use App\Models\UserGifs;
use App\Repositories\Contracts\IUserGifRepository;
use Illuminate\Support\Facades\Log;

readonly class UserGifService
{
    public function __construct(private IUserGifRepository $userGifRepository)
    {
    }
    
    /**
     * @throws UserGifServiceException
     */
    public function storeFavoriteGif(StoreUserGifDto $storeUserGifDto): UserGifs
    {
        try {
            return $this->userGifRepository->storeGif($storeUserGifDto);
        } catch (\Throwable $th) {
            Log::error('Error storing favorite gif: ' . $th->getMessage());
            throw new UserGifServiceException($th->getMessage());
        }
        
    }
    
}