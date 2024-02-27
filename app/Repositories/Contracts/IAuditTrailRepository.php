<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/27 10:18
 */

namespace App\Repositories\Contracts;

use App\Dtos\Audit\StoreAuditDto;
use App\Models\AuditTrail;

interface IAuditTrailRepository
{
    public function storeAudit(StoreAuditDto $storeAuditDto): AuditTrail;
}