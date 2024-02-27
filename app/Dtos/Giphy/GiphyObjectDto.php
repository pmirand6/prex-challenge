<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/26 20:22
 */

namespace App\Dtos\Giphy;

use Spatie\LaravelData\Data;

/**
 * Based on schema definition https://developers.giphy.com/docs/api/schema/#gif-object
 */
class GiphyObjectDto extends Data
{
    public function __construct(
        public string $type,
        public string $id,
        public string $slug,
        public string $url,
        public string $bitly_url,
        public string $embed_url,
        public string $username,
        public string $source,
        public string $rating,
        public string $content_url,
        public ?GiphyUserDto $user,
        public string $source_tld,
        public string $source_post_url,
        public ?string $update_datetime,
        public ?string $create_datetime,
        public string $import_datetime,
        public string $trending_datetime,
        public array $images,
        public string $title,
        public ?string $alt_text,
    ) {
    }
    
}