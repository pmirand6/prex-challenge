<?php

namespace App\Http\Middleware;

use App\Dtos\Audit\StoreAuditDto;
use App\Services\AuditTrailService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuditMiddleware
{
    public function __construct(private readonly AuditTrailService $auditTrailService)
    {
    }
    
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
    
    public function terminate(Request $request, Response $response): void
    {
        try {
            $user = $request->user();
            $url = $request->url();
            $requestBody = $request->all();
            $response = $response->getContent();
            $clientIpAddress = $request->getClientIp();
            
            $dto = new StoreAuditDto(
                url: $url,
                requestBody: $requestBody,
                response: $response,
                clientIpAddress: $clientIpAddress,
                userId: $user->id
            );
            $this->auditTrailService->storeAudit($dto);
        } catch (\Throwable $e) {
            Log::error('Error creating audit trail', ['error' => $e->getMessage()]);
            return;
        }
        
    }
}
