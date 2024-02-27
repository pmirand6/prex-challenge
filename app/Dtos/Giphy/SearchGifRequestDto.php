<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/26 19:53
 */

namespace App\Dtos\Giphy;

use Spatie\LaravelData\Data;

class SearchGifRequestDto extends Data
{
    public function __construct(
        public string $keyword,
        public int $limit = 1,
        public int $offset = 0
    ) {
    }
    
}