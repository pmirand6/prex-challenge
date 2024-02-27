<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/26 21:59
 */

namespace App\Repositories\Contracts;

use App\Dtos\UserGifs\StoreUserGifDto;
use App\Models\UserGifs;

interface IUserGifRepository
{
    public function storeGif(StoreUserGifDto $storeUserGifDto): UserGifs;
}