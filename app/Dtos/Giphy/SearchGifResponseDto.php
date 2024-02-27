<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/26 19:53
 */

namespace App\Dtos\Giphy;

use Spatie\LaravelData\Data;

class SearchGifResponseDto extends Data
{
    public function __construct(
        /** @var array<GiphyObjectDto> */
        public array $data,
        public array $meta,
        public array $pagination
    ) {
    }
    
}