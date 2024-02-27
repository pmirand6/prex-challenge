<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/27 10:21
 */

namespace App\Repositories;

use App\Dtos\Audit\StoreAuditDto;
use App\Models\AuditTrail;
use App\Repositories\Contracts\IAuditTrailRepository;

readonly class AuditTrailRepository implements Contracts\IAuditTrailRepository
{
    
    public function __construct(private AuditTrail $model)
    {
    }
    
    public function storeAudit(StoreAuditDto $storeAuditDto): AuditTrail
    {
        return $this->model->create([
            'url' => $storeAuditDto->url,
            'request_body' => json_encode($storeAuditDto->requestBody),
            'response' => $storeAuditDto->response,
            'client_ip_address' => $storeAuditDto->clientIpAddress,
            'user_id' => $storeAuditDto->userId
        ]);
    }
}