<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/26 22:05
 */

namespace App\Dtos\UserGifs;

use Spatie\LaravelData\Data;

class StoreUserGifDto extends Data
{
    public function __construct(
        public int $userId,
        public int $gifId,
        public string $alias
    ) {
    }
    
}