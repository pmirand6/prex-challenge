<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/26 21:59
 */

namespace App\Repositories;

use App\Dtos\UserGifs\StoreUserGifDto;
use App\Models\UserGifs;
use App\Repositories\Contracts\IUserGifRepository;

readonly class UserGifRepository implements IUserGifRepository
{
    
    public function __construct(private UserGifs $model)
    {
    }
    
    public function storeGif(StoreUserGifDto $storeUserGifDto): UserGifs
    {
        return $this->model->create([
            'user_id' => $storeUserGifDto->userId,
            'gif_id' => $storeUserGifDto->gifId,
            'alias' => $storeUserGifDto->alias
        ]);
    }
}