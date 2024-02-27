<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/26 19:53
 */

namespace App\Dtos\Giphy;

use Spatie\LaravelData\Data;

class SearchByIdGifResponseDto extends Data
{
    public function __construct(
        public GiphyObjectDto $data,
        public array $meta,
    ) {
    }
    
}