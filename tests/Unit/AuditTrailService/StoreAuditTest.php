<?php
/**
 * Creator: Pablo Miranda
 * Date: 2024/02/27 10:43
 */

namespace Tests\Unit\AuditTrailService;

use App\Dtos\Audit\StoreAuditDto;
use App\Repositories\Contracts\IAuditTrailRepository;
use App\Services\AuditTrailService;
use Mockery;
use Tests\TestCase;

class StoreAuditTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->mockIAuditTrailRepository = Mockery::mock(IAuditTrailRepository::class);
    }
    
    private function getServiceInstance(): AuditTrailService
    {
        return new AuditTrailService($this->mockIAuditTrailRepository);
    }
    
    public function test_can_instantiate_service()
    {
        $service = $this->getServiceInstance();
        $this->assertInstanceOf(AuditTrailService::class, $service);
    }
    
    
    public function test_store_audit(): void
    {
        $service = $this->getServiceInstance();
        $dto = new StoreAuditDto(
            url: 'testUrl',
            requestBody: ['test' => 'test'],
            response: 'testResponse',
            clientIpAddress: 'testIp',
            userId: 1
        );
        $this->mockIAuditTrailRepository->shouldReceive('storeAudit')->with($dto)->once();
        $result = $service->storeAudit($dto);
        $this->assertTrue($result);
    }
    
    public function test_store_audit_throws_exception(): void
    {
        $service = $this->getServiceInstance();
        $dto = new StoreAuditDto(
            url: 'testUrl',
            requestBody: ['test' => 'test'],
            response: 'testResponse',
            clientIpAddress: 'testIp',
            userId: 1
        );
        $this->mockIAuditTrailRepository->shouldReceive('storeAudit')
            ->with($dto)
            ->andThrow(new \Exception('Error'));
        $result = $service->storeAudit($dto);
        $this->assertFalse($result);
    }
    
}