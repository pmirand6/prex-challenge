<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/26 20:28
 */

namespace App\Dtos\Giphy;

use Spatie\LaravelData\Data;

class GiphyUserDto extends Data
{
    public function __construct(
        public string $avatar_url,
        public string $banner_url,
        public string $profile_url,
        public string $username,
        public string $display_name,
    )
    {
    }
}