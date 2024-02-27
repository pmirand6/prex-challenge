<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/27 10:19
 */

namespace App\Dtos\Audit;

use Spatie\LaravelData\Data;

class StoreAuditDto extends Data
{
    public function __construct(
        public string $url,
        public array $requestBody,
        public string $response,
        public string $clientIpAddress,
        public int $userId,
    ) {
    }
}