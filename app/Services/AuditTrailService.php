<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/27 10:29
 */

namespace App\Services;

use App\Dtos\Audit\StoreAuditDto;
use App\Repositories\Contracts\IAuditTrailRepository;
use Illuminate\Support\Facades\Log;

class AuditTrailService
{
    public function __construct(private readonly IAuditTrailRepository $auditTrailRepository)
    {
    }
    
    /**
     * @param StoreAuditDto $storeAuditDto
     * @return bool
     */
    public function storeAudit(StoreAuditDto $storeAuditDto): bool
    {
        try {
            $this->auditTrailRepository->storeAudit($storeAuditDto);
            return true;
        } catch (\Throwable $e) {
            Log::error('Error creating audit trail', ['error' => $e->getMessage()]);
            return false;
        }
        
    }
    
}